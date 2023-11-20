<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    // cart
    public function cart() {
        $user_id = Auth::user()->id;
        $carts = Cart::where('user_id', $user_id)->get();

        $totalPrice = $carts->sum(function ($cart) {
            return $cart->price * $cart->quantity;
        });
        $cart_count = Cart::count();
        return view('user.cart', compact('carts', 'totalPrice','cart_count'));
    }

    public function addToCart(Request $request, $id){
        $user_id = Auth::user()->id;
        $size = $request->size;

        $existingCartItem = Cart::where('user_id', $user_id)->where('product_id', $id) ->where('size', $size)->first();

        $request->validate([
            'size' => 'required',
        ]);

        if ($existingCartItem) {
            $existingCartItem->quantity += 1;
            $existingCartItem->save();
        } else {
            $price = Product::where('id', '=', $id)->pluck('price')->first();

            Cart::create([
                'user_id' => $user_id,
                'product_id' => $id,
                'quantity' => 1,
                'price' => $price,
                'size' => $size
            ]);
        }

        return redirect('/cart');
    }

    public function updateCartById(Request $request, $id){
        $cartItem = Cart::findOrFail($id);
        $productId = $cartItem->product_id;
        $stock = Product::where('id', $productId)->pluck('stock')->first();
        $totalQuantityInCart = Cart::where('product_id', $productId)->sum('quantity');

        $newTotalQuantity = $totalQuantityInCart - $cartItem->quantity + $request->quantity;

        if ($newTotalQuantity > $stock) {
            return redirect('/cart')->with('error', 'Not enough stock for the selected size');
        }

        $cartItem->update([
            'quantity' => $request->quantity,
        ]);

        return redirect('/cart');
    }

    public function deleteCartById($id){
        Cart::destroy($id);
        return redirect('/cart');
    }



    // checkout

    public function order(){
        $user_id = Auth::user()->id;
        $carts = Cart::where('user_id', '=', $user_id)->get();

        $totalPrice = $carts->sum(function ($cart) {
            return $cart->price * $cart->quantity;
        });
        $cart_count = Cart::count();
        return view('user.order', compact('carts','totalPrice','cart_count'));
    }

    public function storeOrder(Request $request){

        $user_id = Auth::user()->id;
        $carts = Cart::where('user_id', '=', $user_id)->get();

        $totalPrice = $carts->sum(function ($cart) {
            return $cart->price * $cart->quantity;
        });

        $request->validate([
            'payment_method' => 'required',
            'payment_proof' => 'required|mimes:png,jpg',
            'shipping_address' => 'required|string',
        ]);
        $fileName = time() . '-' . $user_id . '-' . $request->file('payment_proof')->getClientOriginalName();
        $request->file('payment_proof')->storeAs('/public/payment_proof', $fileName);


        $order = Order::create([
            'user_id' => $user_id,
            'payment_method' => $request->input('payment_method'),
            'shipping_address' => $request->input('shipping_address'),
            'total_price' => $totalPrice,
            'payment_proof' => $fileName
        ]);

        foreach ($carts as $cart) {

            $cart->products->stock = $cart->products->stock - $cart->quantity;
            $cart->products->save();

            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'price' => $cart->price,
                'size' => $cart->size
            ]);
            $cart->delete();
        }

        return redirect('/dashboard')->with('success', 'Order placed successfully.');
    }

    public function updatePayment($id, Request $request){
        $user_id = Auth::user()->id;
        $image = $request->file('payment_proof');
        $order = Order::findOrFail($id);

        if($image){
            Storage::delete('/public/payment_proof/'.$order->payment_proof);
            $file_name = time() . '-' . $user_id . '-' . $request->file('payment_proof')->getClientOriginalName();
            $image->storeAs('/public/payment_proof', $file_name);
            $order->update([
                'payment_proof' => $file_name,
                'payment_status' => 'paid'
            ]);
        }

        return redirect(route('myorder'));
    }
}

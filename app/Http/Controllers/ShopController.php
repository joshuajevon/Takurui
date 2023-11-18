<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;

class ShopController extends Controller
{
    // cart
    public function cart() {
        $user_id = Auth::user()->id;
        $carts = Cart::where('user_id', $user_id)->get();

        $totalPrice = $carts->sum(function ($cart) {
            return $cart->price * $cart->quantity;
        });

        return view('user.cart', compact('carts', 'totalPrice'));
    }

    public function addToCart($id){
        $user_id = Auth::user()->id;

        $existingCartItem = Cart::where('user_id', $user_id)->where('product_id', $id)->first();

        if ($existingCartItem) {
            $existingCartItem->quantity += 1;
            $existingCartItem->save();
        } else {
            $price = Product::where('id', '=', $id)->pluck('price')->first();

            Cart::create([
                'user_id' => $user_id,
                'product_id' => $id,
                'quantity' => 1,
                'price' => $price
            ]);
        }

        return redirect('/cart');
    }

    public function updateCartById(Request $request, $id){
        $cartId = Cart::findOrFail($id);
        $pid = $cartId->product_id;
        $stock = Product::where('id', $pid)->pluck('stock')->first();

        if ($request->quantity > $stock) {
            return redirect('/cart')->with('error', 'Not enough stock for product');
        }
        $cartId->update([
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

        return view('user.order', compact('carts','totalPrice'));
    }

    public function storeOrder(Request $request){

        // $request->validate([
        //     'payment_method' => 'required|in:credit_card,paypal', // Sesuaikan dengan opsi yang Anda miliki
        //     'shipping_address' => 'required|string',
        // ]);

        $user_id = Auth::user()->id;
        $carts = Cart::where('user_id', '=', $user_id)->get();

        $totalPrice = $carts->sum(function ($cart) {
            return $cart->price * $cart->quantity;
        });

        $fileName = time() . '-' . $user_id . $request->file('payment_proof')->getClientOriginalName();
        $request->file('payment_proof')->storeAs('/public/payment_proof', $fileName);

        $order = Order::create([
            'user_id' => $user_id,
            'payment_method' => $request->input('payment_method'),
            'shipping_address' => $request->input('shipping_address'),
            'total_price' => $totalPrice,
            'payment_proof' => $fileName
        ]);

        foreach ($carts as $cart) {

            if ($cart->quantity > $cart->products->stock) {
                return redirect('/order')->with('error', 'Not enough stock for product: ' . $cart->product->name);
            }

            $cart->products->stock = $cart->products->stock - $cart->quantity;
            $cart->products->save();

            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'price' => $cart->price
            ]);
            $cart->delete();

            if ($cart->products->stock === 0) {
                Product::where('id', $cart->products->id)->delete();
            }
        }


        return redirect('/dashboard')->with('success', 'Order placed successfully.');
    }
}

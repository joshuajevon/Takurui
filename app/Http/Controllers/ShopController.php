<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\Cart;

class ShopController extends Controller
{
    public function cart() {
        $carts = Cart::all();

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

        $cartId->update([
            'quantity' => $request->quantity,
        ]);

        return redirect('/cart');
    }

    public function deleteCartById($id){
        Cart::destroy($id);
        return redirect('/cart');
    }
}

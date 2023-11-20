<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(){
        $cart_count = Cart::count();
        return view('user.dashboard', compact('cart_count'));
    }
    public function profile(){
        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);
        $cart_count = Cart::count();
        return view('user.profile', compact('user','cart_count'));
    }

    public function myorder(){
        $user_id = Auth::user()->id;
        $order = Order::where('user_id',$user_id)->get();
        $cart_count = Cart::count();
        return view('user.myorder',compact('order','cart_count'));
    }

    public function myOrderById($id){
        $user_id = Auth::user()->id;
        $order = Order::where('user_id',$user_id)->where('id',$id)->first();
        $cart_count = Cart::count();
        return view('user.myorderbyid',compact('order','cart_count'));
    }
}

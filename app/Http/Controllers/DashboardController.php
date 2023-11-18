<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(){
        return view('user.dashboard');
    }
    public function profile(){
        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);

        return view('user.profile', compact('user'));
    }

    public function myorder(){
        $user_id = Auth::user()->id;
        $order = Order::where('user_id',$user_id)->get();
        return view('user.myorder',compact('order'));
    }

    public function myOrderById($id){
        $user_id = Auth::user()->id;
        $order = Order::where('user_id',$user_id)->where('id',$id)->first();
        return view('user.myorderbyid',compact('order'));
    }
}

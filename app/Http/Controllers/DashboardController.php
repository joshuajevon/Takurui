<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // user dashboard
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


    // admin dashboard payment
    public function adminPaymentDashboard(){
        $orders = Order::paginate(10);
        $cart_count = Cart::count();
        return view('admin.payment.dashboard', compact('orders','cart_count'));
    }

    public function verifyPayment($id){
        Order::where('id','=',$id)->update([
            'payment_status' => 'accepted'
        ]);
        return redirect(route('adminPaymentDashboard'));
    }

    public function rejectPayment($id){
        Order::where('id','=',$id)->update([
            'payment_status' => 'rejected'
        ]);
        return redirect(route('adminPaymentDashboard'));
    }

    public function filterPayments(Request $request, $status) {
        $orders = Order::where('payment_status','=', $status)->paginate(10);
        $cart_count = Cart::count();
        return view('admin.payment.dashboard', compact('orders','cart_count'));
    }

    // admin dashboard shipment
    public function adminShipmentDashboard(){
        $orders = Order::paginate(10);
        $cart_count = Cart::count();
        return view('admin.shipment.dashboard', compact('orders','cart_count'));
    }

    public function pendingShipment($id){
        Order::where('id','=',$id)->update([
            'shipment_status' => 'Pending'
        ]);
        return redirect(route('adminShipmentDashboard'));
    }

    public function processingShipment($id){
        Order::where('id','=',$id)->update([
            'shipment_status' => 'Processing'
        ]);
        return redirect(route('adminShipmentDashboard'));
    }

    public function shippedShipment($id){
        Order::where('id','=',$id)->update([
            'shipment_status' => 'Shipped'
        ]);
        return redirect(route('adminShipmentDashboard'));
    }

    public function deliveredShipment($id){
        Order::where('id','=',$id)->update([
            'shipment_status' => 'Delivered'
        ]);
        return redirect(route('adminShipmentDashboard'));
    }

    public function filterShipments(Request $request, $status) {
        $orders = Order::where('shipment_status','=', $status)->paginate(10);
        $cart_count = Cart::count();
        return view('admin.shipment.dashboard', compact('orders','cart_count'));
    }
}

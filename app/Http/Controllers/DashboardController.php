<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    // user dashboard
    public function dashboard(){
        $cart_count = Cart::count();
        return view('user.dashboard', compact('cart_count'));
    }

    // profile
    public function profile(){
        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);
        $cart_count = Cart::count();
        return view('user.profile', compact('user','cart_count'));
    }

    public function editProfile($id){
        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);
        $cart_count = Cart::count();

        return view('user.editProfile', compact('user','cart_count'));
    }

    public function updateProfile(Request $request, $id){

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phoneNumber' => 'required|integer',
            'dob' => 'required|date',
            'gender' => 'required',
            'address' => 'required'
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phoneNumber' => $request->phoneNumber,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'address' => $request->address,
        ]);
        return redirect(route('profile'))->with('success',"Profile changed successfully!");
    }

    public function updatePassword(Request $request){

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }


        $user_id = Auth::user()->id;

        User::where('id',$user_id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect(route('profile'))->with('success',"Password changed successfully!");
    }


    // order
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
    public function adminPaymentDashboard(Request $request){
        $result = $request->input('search');
        if($result){
            $orders = Order::where('id','=',$result)->paginate(10);
        } else{
            $orders = Order::paginate(10);
        }
        return view('admin.payment.dashboard', compact('orders'));
    }

    public function verifyPayment($id){
        $order = Order::findOrFail($id);

        $order->update([
            'payment_status' => 'accepted',
            'shipment_status' => "Processing",
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
        return view('admin.payment.dashboard', compact('orders'));
    }

    // admin dashboard shipment
    public function adminShipmentDashboard(Request $request){
        $result = $request->input('search');
        if($result){
            $orders = Order::where('id','=',$result)->paginate(10);
        } else{
            $orders = Order::paginate(10);
        }
        return view('admin.shipment.dashboard', compact('orders'));
    }

    public function updateShipment(Request $request, $id){
        $order = Order::findOrFail($id);
        $order->update([
            'shipment_status' =>$request->shipment_status,
        ]);
        return redirect(route('adminShipmentDashboard'));
    }

    public function filterShipments(Request $request, $status) {
        $orders = Order::where('shipment_status','=', $status)->paginate(10);
        return view('admin.shipment.dashboard', compact('orders'));
    }

    // admin dashboard user

    public function adminUserDashboard(Request $request){

        if($request->input('search')){
            $users = User::where('name','like','%' .request('search'). '%')->paginate(10);
        } else{
            $users = User::paginate(10);
        }

        return view('admin.user.dashboard', compact('users'));
    }

    public function editUser($id){
        $user = User::findOrFail($id);
        return view('admin.user.editUser', compact('user'));
    }

    public function viewUser($id){
        $user = User::findOrFail($id);
        return view('admin.user.viewUser', compact('user'));
    }

    public function updateUser(Request $request, $id){

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phoneNumber' => 'required|integer',
            'dob' => 'required|date',
            'gender' => 'required',
            'address' => 'required'
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phoneNumber' => $request->phoneNumber,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'address' => $request->address,
        ]);
        return redirect('/admin/user/');
    }

    public function deleteUser($id){
        User::destroy($id);
        return redirect(route('adminUserDashboard'));
    }
}

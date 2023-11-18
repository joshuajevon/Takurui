@extends('template.template')

@section('head')

@endsection

@section('body')
<br><br><br><br><br>
<h1>My Order</h1>


    <table class="table">
        <thead>
            <tr>
                <th scope="col">Order Id</th>
                <th scope="col">Shipment Status</th>
                <th scope="col">Payment Status</th>
                <th scope="col">Payment Method</th>
                <th scope="col">Shipping Address</th>
                <th scope="col">Total Price</th>
                <th scope="col">View</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order as $ord)
            <tr>
                <th>{{$ord->id}}</th>
                <th >{{$ord->shipment_status}}</th>
                <th >{{$ord->payment_status}}</th>
                <th >{{$ord->payment_method}}</th>
                <th >{{$ord->shipping_address}}</th>
                <th >@currency($ord->total_price)</th>
                <th>
                    <a class="btn btn-primary" href="{{route('myOrderById', $ord->id)}}">View</a>
                </th>
            </tr>
            @endforeach
        </tbody>
    </table>


@endsection

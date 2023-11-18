@extends('template.template')

@section('head')

@endsection

@section('body')
<br><br><br><br><br>
<h1>Order #{{$order->id}}</h1>

@foreach ($order->orderProducts as $orderItem)
<img src="{{ asset('/storage/image/' . $orderItem->product->image) }}" width="100" height="100" class="img-responsive" />
    {{$orderItem->product->name}}

    {{$orderItem->quantity}}x
    @currency($orderItem->price)
    <br><br>
@endforeach

<strong>Total:</strong> @currency($order->total_price)
<br><br>
<h4>Payment Status</h4>

@if ($order->payment_status == 'paid')
    <strong>Paid</strong>
    <br>
    Thank you for the payment, please wait for the verification process.
    <br>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Payment Receipt
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Payment Receipt</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <img src="{{ asset('/storage/payment_proof/' . $order->payment_proof) }}" style="width:29rem" alt="">
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>

@elseif ($order->payment_status == 'rejected')
    <strong>Rejected</strong>
    <br>
    Your payment failed to be verified. Please upload your payment proof again.

    <form action="{{route('updatePayment',$order->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <label for="">Please Reupload Your Payment Proof!</label>
        <br>
        <input type="file" name="payment_proof" id="">
        <br>
        <button type="submit">Save</button>
    </form>

@elseif ($order->payment_status == 'accepted')
    <strong>Accepted</strong>
    <br>
    Your payment has been successfully verified!
    <br>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Payment Receipt
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Payment Receipt</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <img src="{{ asset('/storage/payment_proof/' . $order->payment_proof) }}" style="width:29rem" alt="">
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>
@endif

<br><br>
<h4>Shipment Status</h4>
@if ($order->shipment_status == 'Pending')
    <strong>Pending</strong>
    After the payment is verified, your order will be shipped promptly.
@elseif ($order->shipment_status == 'Processing')
<strong>Processing</strong>
Your order will be shipped shortly.
@elseif ($order->shipment_status == 'Shipped')
<strong>Shipped</strong>
Your order is currently in the process of being shipped.
@elseif ($order->shipment_status == 'Delivered')
<strong>Delivered</strong>
Your order has been successfully shipped.
@endif


@endsection

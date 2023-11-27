@extends('template.template')

@section('head')

@endsection

@section('body')
<div class="pt-5 bg-body-secondary">
    <div class="pt-5">
        <div class="py-5">
            <div class="py-5 container d-flex flex-column gap-4 gap-lg-5 min-vh-100">
                <div class="d-flex flex-row gap-5">
                    <a href="{{ route('myorder') }}" class="btn btn-dark d-flex justify-content-center align-items-center fw-semibold" style="width: fit-content;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                        </svg>
                    </a>
                    <h1 class="text-center display-3 w-100">Order #{{$order->id}}</h1>
                </div>

                <div class="d-flex flex-column gap-4 bg-white p-4 p-lg-5">
                    @foreach ($order->orderProducts as $orderItem)
                    <div class="d-flex flex-column flex-lg-row gap-2 gap-lg-3">
                        <div style="width: 150px">
                            <div class="overflow-hidden ratio ratio-1x1">
                                {{-- <img src="{{ asset('assets/temp/sample-2.png')}}" class="object-fit-cover w-100 h-100" alt="{{ $cart->products->name }}"> --}}

                                <img src="{{ asset('/storage/image/' . $orderItem->product->image) }}" width="100" height="100" class="img-responsive" />
                            </div>
                        </div>

                        <div class="d-flex flex-column justify-content-center">
                            <div>
                                <p class="fs-3 m-0">
                                    {{$orderItem->product->name}}
                                </p>
                            </div>

                            <div>
                                <p class="m-0">
                                    Price:
                                    @currency($orderItem->price)
                                </p>
                            </div>

                            <div>
                                <p class="m-0">
                                    Quantity:
                                    {{$orderItem->quantity}}
                                </p>
                            </div>

                            <div>
                                <p class="m-0">
                                    Size:
                                    {{$orderItem->size}}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="d-flex flex-column bg-white p-4 p-lg-5 gap-5">
                    <div class="d-flex flex-column">
                        <p class="fs-2 fw-bold m-0">Total Price:</p>
                        <p class="fs-5 m-0"> @currency($order->total_price)</p>
                    </div>

                    <div class="d-flex flex-column">
                        <p class="fs-2 fw-bold m-0">Payment Status:</p>

                        @if ($order->payment_status == 'paid')
                        <p class="fs-5 text-warning fw-bold">Paid</p>
                        <p class="fs-5">
                            Thank you for the payment, please wait for the verification process.
                        </p>
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
                        <p class="fs-5 text-danger fw-bold">Rejected</p>
                        <p class="fs-5">
                            Your payment failed to be verified. Please upload your payment proof again.
                        </p>

                        <form action="{{route('updatePayment',$order->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <label for="">Please Reupload Your Payment Proof!</label>
                            <br>
                            <input class="form-control" type="file" name="payment_proof" id="">
                            <br>
                            <button class="btn btn-success" type="submit">Save</button>
                        </form>

                        @elseif ($order->payment_status == 'accepted')
                        <p class="fs-5 text-success fw-bold">Accepted</p>
                        <p class="fs-5">
                            Your payment has been successfully verified!
                        </p>

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
                    </div>

                    <div class="d-flex flex-column">
                        <p class="fs-2 fw-bold m-0">Shipment Status:</p>
                        @if ($order->shipment_status == 'Pending')
                        <p class="fs-5 fw-bold text-warning">
                            Pending
                        </p>
                        <p class="fs-5">
                            After the payment is verified, your order will be shipped promptly.
                        </p>
                        @elseif ($order->shipment_status == 'Processing')
                        <p class="fs-5 fw-bold text-warning">
                            Processing
                        </p>
                        <p class="fs-5">
                            Your order will be shipped shortly.
                        </p>
                        @elseif ($order->shipment_status == 'Shipped')
                        <p class="fs-5 fw-bold text-primary">
                            Shipped
                        </p>
                        <p class="fs-5">
                            Your order is currently in the process of being shipped.
                        </p>
                        @elseif ($order->shipment_status == 'Delivered')
                        <p class="fs-5 fw-bold text-success">
                            Delivered
                        </p>
                        <p class="fs-5">
                            Your order has been successfully shipped.
                        </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

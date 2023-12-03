@extends('template.template')

@section('head')

@endsection

@section('body')
<div class="pt-sm-5 bg-body-secondary">
    <div class="pt-5">
        <div class="py-5">
            <div class="py-5 container d-flex flex-column gap-4 gap-lg-5 min-vh-100">
                <div class="d-flex flex-column gap-3">
                    <a href="{{ route('dashboard')}}" class="btn btn-dark d-flex justify-content-center align-items-center p-2 p-sm-3" style="width: fit-content;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
                        </svg>
                    </a>
                    <h1 class="text-center display-3 w-100">My Order</h1>
                </div>

                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" style="min-width: 8rem;">Order Id</th>
                                <th scope="col" style="min-width: 12rem;">Shipment Status</th>
                                <th scope="col" style="min-width: 12rem;">Payment Status</th>
                                <th scope="col" style="min-width: 12rem;">Payment Method</th>
                                <th scope="col" style="min-width: 12rem;">Shipping Address</th>
                                <th scope="col" style="min-width: 12rem;">Total Price</th>
                                <th scope="col" style="min-width: 8rem;">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order as $ord)
                            <tr>
                                <td>{{$ord->id}}</td>
                                <td>
                                    @if($ord->shipment_status == "Pending")
                                    <p class="fs-6 text-warning fw-bold">Pending</p>
                                    @elseif($ord->shipment_status == "Processing")
                                    <p class="fs-6 text-warning fw-bold">Processing</p>
                                    @elseif($ord->shipment_status == "Shipped")
                                    <p class="fs-6 text-primary fw-bold">Shipped</p>
                                    @else
                                    <p class="fs-6 text-success fw-bold">Delivered</p>
                                    @endif
                                </td>
                                <td>
                                    @if($ord->payment_status == "paid")
                                    <p class="fs-6 text-warning fw-bold">Paid</p>
                                    @elseif($ord->payment_status == "rejected")
                                    <p class="fs-6 text-danger fw-bold">Rejected</p>
                                    @else
                                    <p class="fs-6 text-success fw-bold">Accepted</p>
                                    @endif
                                </td>
                                <td>{{$ord->payment_method}}</td>
                                <td>{{$ord->shipping_address}}</td>
                                <td>@currency($ord->total_price)</td>
                                <td>
                                    <a class="btn btn-primary" href="{{route('myOrderById', $ord->id)}}">View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

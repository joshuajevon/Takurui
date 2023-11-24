@extends('template.template')

@section('head')

@endsection

@section('body')
<div class="pt-5 bg-body-secondary">
    <div class="pt-5">
        <div class="py-5">
            <div class="py-5 container d-flex flex-column gap-4 gap-lg-5 min-vh-100">
                <h1 class="text-center display-3 w-100">Profile</h1>

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
                                <td>{{$ord->shipment_status}}</td>
                                <td>{{$ord->payment_status}}</td>
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

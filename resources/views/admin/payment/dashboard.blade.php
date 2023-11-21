@extends('template.template')

@section('head')

@endsection

@section('body')

    <div class="pt-5">
        <div class="pt-5">
            <div class="pt-5">
                <div class="container min-vh-100 d-flex flex-column gap-4">
                    <nav class="nav nav-pills nav-fill">
                        <a href="{{route('adminProductDashboard')}}" class="nav-link fw-semibold text-dark">Product</a>
                        <a href="{{route('adminPaymentDashboard')}}" class="nav-link  bg-dark text-light fw-semibold">Payment</a>
                        <a href="{{route('adminShipmentDashboard')}}" class="nav-link fw-semibold text-dark">Shipment</a>
                    </nav>

                    <table class="table table-sm table-dark table-hover table-striped text-center">
                        <thead>
                            <tr>
                                <th scope="col" class="p-2">Order Id </th>
                                <th scope="col" class="p-2">User Name</th>
                                <th scope="col" class="p-2">Total Price</th>
                                <th scope="col" class="p-2">Payment Method</th>
                                <th scope="col" class="p-2">Status</th>
                                <th scope="col" class="p-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <div>
                                <a class="btn btn {{ request()->is('admin/payment') ? 'btn-dark' : 'btn-outline-dark' }}" href="{{url('admin/payment/')}}">
                                    All
                                </a>
                                <a class="btn {{ request()->is('admin/payment/paid*') ? 'btn-dark' : 'btn-outline-dark' }}" href="{{url('admin/payment/paid ')}}">
                                    Unverified
                                </a>
                                <a class="btn btn {{ request()->is('admin/payment/accepted*') ? 'btn-dark' : 'btn-outline-dark' }}" href="{{url('admin/payment/accepted')}}">
                                    Verified
                                </a>
                                <a class="btn btn {{ request()->is('admin/payment/rejected*') ? 'btn-dark' : 'btn-outline-dark' }}" href="{{url('admin/payment/rejected')}}">
                                    Rejected
                                </a>
                            </div>

                            @foreach ($orders as $order)
                            <tr>
                                <td class="p-2">{{$order->id}}</td>
                                <td class="p-2">{{$order->user->name}}</td>
                                <td class="p-2">@currency($order->total_price)</td>
                                <td class="p-2">{{$order->payment_method}}</td>
                                <td class="p-2">
                                    @if (str_contains($order->payment_status, 'paid'))
                                    <div>
                                        Unverified
                                    </div>
                                    @elseif (str_contains($order->payment_status, 'accepted'))
                                    <div>
                                        Verified
                                    </div>
                                    @elseif (str_contains($order->payment_status, 'rejected'))
                                    <div>
                                        Rejected
                                    </div>
                                    @endif
                                </td>
                                <td class="p-2">

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#view{{ $order->id }}">
                                        View
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="view{{ $order->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-5 text-black" id="exampleModalLabel">Payment Details</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-black d-flex flex-column">
                                                <h1>Order #{{$order->id}}</h1>

                                                <div class="flex-column">
                                                    @foreach ($order->orderProducts as $orderItem)
                                                    <img src="{{ asset('/storage/image/' . $orderItem->product->image) }}" width="100" height="100" class="img-responsive" />
                                                        {{$orderItem->product->name}}
                                                        {{$orderItem->size}} .  {{$orderItem->quantity}}x
                                                        <br>
                                                        Sub Total: @currency($orderItem->price)
                                                        <br><br>
                                                    @endforeach
                                                </div>

                                                <div class="flex-row">
                                                    <strong>Total:</strong> @currency($order->total_price)
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                    </div>



                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verif{{ $order->id }}">
                                        >
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="verif{{ $order->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h1 class="modal-title fs-5 text-black" id="exampleModalLabel">Payment Confirmation</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-black">
                                                    <img src="{{ asset('/storage/payment_proof/' . $order->payment_proof) }}" style="width:29rem" alt="">
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('verifyPayment', $order->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button class="btn btn-success">Verify</button>
                                                    </form>

                                                    <form action="{{ route('rejectPayment', $order->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button class="btn btn-danger">Reject</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                            {{-- PAGINATION --}}
                            @if ($orders->hasPages())
                            <nav class="d-flex justify-items-center justify-content-between w-100">
                                <div class="d-flex justify-content-between flex-fill d-sm-none">
                                    <ul class="pagination">
                                        {{-- Previous Page Link --}}
                                        @if ($orders->onFirstPage())
                                        <li class="page-item disabled" aria-disabled="true">
                                            <span class="page-link">@lang('pagination.previous')</span>
                                        </li>
                                        @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $orders->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
                                        </li>
                                        @endif

                                        {{-- Next Page Link --}}
                                        @if ($orders->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $orders->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
                                        </li>
                                        @else
                                        <li class="page-item disabled" aria-disabled="true">
                                            <span class="page-link">@lang('pagination.next')</span>
                                        </li>
                                        @endif
                                    </ul>
                                </div>

                                <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
                                    <div>
                                        <p class="small text-muted">
                                            {!! __('Showing') !!}
                                            <span class="fw-semibold">{{ $orders->firstItem() }}</span>
                                            {!! __('to') !!}
                                            <span class="fw-semibold">{{ $orders->lastItem() }}</span>
                                            {!! __('of') !!}
                                            <span class="fw-semibold">{{ $orders->total() }}</span>
                                            {!! __('results') !!}
                                        </p>
                                    </div>

                                    <div>
                                        <ul class="pagination">
                                            {{-- Previous Page Link --}}
                                            @if ($orders->onFirstPage())
                                            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                                                <span class="page-link" aria-hidden="true">&lsaquo;</span>
                                            </li>
                                            @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $orders->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                                            </li>
                                            @endif

                                            {{-- Next Page Link --}}
                                            @if ($orders->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $orders->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                                            </li>
                                            @else
                                            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                                                <span class="page-link" aria-hidden="true">&rsaquo;</span>
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                            @endif
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

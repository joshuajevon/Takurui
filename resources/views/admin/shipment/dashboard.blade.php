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
                        <a href="{{route('adminPaymentDashboard')}}" class="nav-link fw-semibold text-dark">Payment</a>
                        <a href="{{route('adminShipmentDashboard')}}" class="nav-link  bg-dark text-light fw-semibold">Shipment</a>
                    </nav>

                    <table class="table table-sm table-dark table-hover table-striped text-center">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 10px" class="p-2">Order Id </th>
                                <th scope="col" style="width: 10px" class="p-2">User Name</th>
                                <th scope="col" style="width: 10px" class="p-2" >Shipping Address</th>
                                <th scope="col" style="width: 10px" class="p-2">Status</th>
                                <th scope="col" style="width: 10px" class="p-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <div>
                                <a class="btn btn {{ request()->is('admin/shipment') ? 'btn-dark' : 'btn-outline-dark' }}" href="{{url('admin/shipment/')}}">
                                    All
                                </a>
                                <a class="btn {{ request()->is('admin/shipment/pending*') ? 'btn-dark' : 'btn-outline-dark' }}" href="{{url('admin/shipment/pending ')}}">
                                    Pending
                                </a>
                                <a class="btn btn {{ request()->is('admin/shipment/processing*') ? 'btn-dark' : 'btn-outline-dark' }}" href="{{url('admin/shipment/processing')}}">
                                    Processing
                                </a>
                                <a class="btn btn {{ request()->is('admin/shipment/shipped*') ? 'btn-dark' : 'btn-outline-dark' }}" href="{{url('admin/shipment/shipped')}}">
                                    Shipped
                                </a>
                                <a class="btn btn {{ request()->is('admin/shipment/delivered*') ? 'btn-dark' : 'btn-outline-dark' }}" href="{{url('admin/shipment/delivered')}}">
                                    Delivered
                                </a>
                            </div>

                            @foreach ($orders as $order)
                            <tr>
                                <td class="p-2">{{$order->id}}</td>
                                <td class="p-2">{{$order->user->name}}</td>
                                <td class="p-2">{{ $order->shipping_address }}</td>
                                <td class="p-2">{{$order->shipment_status}}</td>
                                <td class="p-2">
                                    <form action="{{ route('updateShipment', $order->id) }}" class="d-flex flex-row gap-2" method="POST">
                                        @csrf
                                        @method('patch')
                                        <select class="form-select" aria-label="Default select example" name="shipment_status">
                                            <option value="Pending" @if($order->shipment_status == 'Pending') selected @endif>Pending</option>
                                            <option value="Processing" @if($order->shipment_status == "Processing") selected @endif>Processing</option>
                                            <option value="Shipped" @if($order->shipment_status == 'Shipped') selected @endif>Shipped</option>
                                            <option value="Delivered" @if($order->shipment_status == 'Delivered') selected @endif>Delivered</option>
                                        </select>

                                        <button class="btn btn-success" type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy-fill" viewBox="0 0 16 16">
                                                <path d="M0 1.5A1.5 1.5 0 0 1 1.5 0H3v5.5A1.5 1.5 0 0 0 4.5 7h7A1.5 1.5 0 0 0 13 5.5V0h.086a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5H14v-5.5A1.5 1.5 0 0 0 12.5 9h-9A1.5 1.5 0 0 0 2 10.5V16h-.5A1.5 1.5 0 0 1 0 14.5z"/>
                                                <path d="M3 16h10v-5.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5zm9-16H4v5.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5zM9 1h2v4H9z"/>
                                              </svg>
                                        </button>
                                    </form>
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

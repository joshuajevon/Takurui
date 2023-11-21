@extends('template.template')

@section('head')

@endsection

@section('body')
<div class="pt-5 bg-body-secondary">
    <div class="pt-5">
        <div class="py-5">
            <div class="py-5 d-flex flex-column gap-5 min-vh-100">
                <h1 class="text-center display-3 w-100">MY CART</h1>


                <div class="container p-5 bg-light d-flex flex-column gap-4 overflow-x-auto">

                    @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif

                    <table id="cart" class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th class="" style="min-width: 32rem;">Product</th>
                                <th style="min-width: 10rem;">Price</th>
                                <th style="min-width: 8rem;">Quantity</th>
                                <th style="min-width: 4rem;">Size</th>
                                <th style="min-width: 12rem;">Subtotal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $cart)
                            <tr>
                                <td data-th="Product">
                                    <div class="d-flex gap-3">
                                        <div style="width: 150px">
                                            <div class="overflow-hidden ratio ratio-1x1">
                                                {{-- <img src="{{ asset('assets/temp/sample-2.png')}}" class="object-fit-cover w-100 h-100" alt="{{ $cart->products->name }}"> --}}

                                                <img src="{{ asset('/storage/image/' . $cart->products->image) }}" width="100" height="100" class="img-responsive" />
                                            </div>
                                        </div>
                                        <div class="w-100">
                                            <p class="fs-4">{{ $cart->products->name }}</p>
                                        </div>
                                    </div>
                                </td>

                                <td data-th="Price">
                                    @currency($cart->price)
                                </td>

                                <td data-th="Quantity">
                                    <form action="{{ route('updateCartById', $cart->id) }}" method="POST" class="d-flex">
                                        @csrf
                                        @method('patch')
                                        <input type="number" name="quantity" value="{{ $cart->quantity }}" class="rounded-0 form-control quantity cart_update" min="1" />
                                        <button type="submit" class="rounded-0 btn btn-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>

                                <td data-th="Size">
                                    {{$cart->size}}
                                </td>

                                <td data-th="Subtotal">
                                    @currency( $cart->price * $cart->quantity )
                                </td>

                                <td class="actions" data-th="">
                                    <form action="{{ route('deleteCartById', $cart->id) }}" method="POST" class="d-flex justify-content-center">
                                        @csrf
                                        @method('delete')
                                        <button class="rounded-0 btn btn-danger cart_remove">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-right">
                                    <h3><strong>Total @currency($totalPrice)</strong></h3>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-right">
                                    <a href="{{ url('/') }}" class="btn btn-danger"> <i class="fa fa-arrow-left"></i>
                                        Continue
                                        Shopping</a>
                                    <a type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Checkout</a>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure want to checkout?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>

                                                    <a type="button" href="{{url('/order  ')}}" class="btn btn-success">Yes</a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>



    </html>

    @endsection

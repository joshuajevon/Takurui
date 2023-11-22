@extends('template.template')

@section('head')

@endsection


@section('body')
<div class="pt-5 bg-body-secondary">
    <div class="pt-5">
        <div class="py-5">
            <div class="py-5 container d-flex flex-column gap-4 gap-lg-5 min-vh-100">
                <h1 class="text-center display-3 w-100">OVERVIEW</h1>

                <div class="d-flex flex-column gap-4 bg-white p-4 p-lg-5">
                    @foreach ($carts as $cart)
                    <div class="d-flex flex-column flex-lg-row gap-2 gap-lg-3">
                        <div style="width: 150px">
                            <div class="overflow-hidden ratio ratio-1x1">
                                {{-- <img src="{{ asset('assets/temp/sample-2.png')}}" class="object-fit-cover w-100 h-100" alt="{{ $cart->products->name }}"> --}}

                                <img src="{{ asset('/storage/image/' . $cart->products->image) }}" width="100" height="100" class="img-responsive" />
                            </div>
                        </div>

                        <div class="d-flex flex-column justify-content-center">
                            <div>
                                <p class="fs-3 m-0">
                                    {{ $cart->products->name }}
                                </p>
                            </div>

                            <div>
                                <p class="m-0">
                                    Price:
                                    @currency($cart->price)
                                </p>
                            </div>

                            <div>
                                <p class="m-0">
                                    Quantity:
                                    {{ $cart->quantity }}
                                </p>
                            </div>

                            <div>
                                <p class="m-0">
                                    Size:
                                    {{ $cart->size }}
                                </p>
                            </div>

                            <div>
                                <p class="m-0">
                                    Sub Total:
                                    @currency( $cart->price * $cart->quantity )
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="d-flex flex-column bg-white p-4 p-lg-5 gap-3 gap-lg-5">
                    <div class="d-flex flex-column">
                        <p class="fs-2 fw-bold m-0">Total Price:</p>
                        <p class="fs-5"> @currency($totalPrice)</p>
                    </div>

                    <form action="{{ route('storeOrder') }}" method="POST" enctype="multipart/form-data" class="d-flex flex-column gap-5">
                        @csrf
                        <div class="d-flex flex-column gap-3 fs-5">
                            <label for="payment_method" class="fs-2 fw-bold">{{ __('Payment Method:') }}</label>

                            <p>Bank Transfer</p>
                            <div class="btn-group" data-toggle="buttons" id="btn-group-id">
                                <label class="btn btn-primary">
                                    <input type="radio" id="BCA" name="payment_method" value="BCA" @if (old('payment_method')=="BCA" ) checked @endif>
                                    BCA
                                </label>
                            </div>

                            <div class="btn-group" data-toggle="buttons" id="btn-group-id">
                                <label class="btn btn-primary">
                                    <input type="radio" id="mandiri" name="payment_method" value="Mandiri" @if (old('payment_method')=="Mandiri" ) checked @endif>
                                  Mandiri
                                </label>
                            </div>

                            <p>E-Wallet</p>

                            <div class="btn-group" data-toggle="buttons" id="btn-group-id">
                                <label class="btn btn-primary">
                                    <input type="radio" id="gopay" name="payment_method" value="Gopay" @if (old('payment_method')=="Gopay" ) checked @endif>
                                    Gopay
                                </label>
                            </div>

                            <div class="btn-group" data-toggle="buttons" id="btn-group-id">
                                <label class="btn btn-primary">
                                    <input type="radio" id="ovo" name="payment_method" value="Ovo" @if (old('payment_method')=="Ovo" ) checked @endif>
                                    Ovo
                                </label>
                            </div>

                            @error('payment_method')
                            <div class="alert alert-danger fs-6 mt-3" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div>
                            <label for="formFile" class="fs-2 fw-bold form-label">Payment Proof:</label>
                            <input class="py-3 form-control @error('payment_proof') is-invalid @enderror" type="file" id="formFile" name="payment_proof">
                            @error('payment_proof')
                            <div class="alert alert-danger fs-6 mt-3" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div>
                            <p class="fs-2 fw-bold m-0">Shipping Address:</p>
                            <input type="text" name="shipping_address" class="py-3 form-control" placeholder="Insert your shipping address">
                            @error('shipping_address')
                            <div class="alert alert-danger fs-6 mt-3" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success py-2 py-lg-3 fw-medium fs-5">Submit Order</button>

                        @if(session('error'))
                        <div class="alert alert-danger fs-6 mt-3" role="alert">
                            {{ session('error') }}
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

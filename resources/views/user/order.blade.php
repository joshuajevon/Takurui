@extends('template.template')

@section('head')

@endsection


@section('body')

    <h1>Overview:</h1>

    @foreach ($carts as $cart)
        <tr data-id="">
            <td data-th="Product">
                <div class="col-sm-3 hidden-xs">
                    <img src="{{ asset('/storage/image/' . $cart->products->image) }}" width="100" height="100" class="img-responsive" />
                </div>
            </td>
            <div class="col-sm-9">
                <h4 class="nomargin">Name: {{ $cart->products->name }}</h4>
            </div>
            <td data-th="Price">
                Price:
                @currency($cart->price)
            </td>
            <br>
            <td data-th="Quantity">
                Quantity:
                {{ $cart->quantity }}
            </td>
            <br>
            <td data-th="Size">
                Size:
                {{ $cart->size }}
            </td>
            <br>
            <td data-th="Subtotal" class="text-center">
                Sub Total:
                @currency( $cart->price * $cart->quantity )
            </td>
        </tr>
        @endforeach

    <h2>Total Price: @currency($totalPrice)</h2>

    <form action="{{ route('storeOrder') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <label for="payment_method" class="">{{ __('Choose Payment Method') }}</label>

            <div class="">
                <input type="radio" id="gopay" name="payment_method" value="gopay" @if (old('payment_method') == "gopay") checked @endif>
                <label for="gopay">Gopay</label>
            </div>

            <div class="">
                <input type="radio" id="BCA" name="payment_method" value="BCA" @if (old('payment_method') == "BCA") checked @endif>
                <label for="BCA">BCA</label>
            </div>

            <div class="">
                <input type="radio" id="ovo" name="payment_method" value="ovo" @if (old('payment_method') == "ovo") checked @endif>
                <label for="ovo">Ovo</label>
            </div>

            <div class="">
                <input type="radio" id="utang" name="payment_method" value="utang" @if (old('payment_method') == "utang") checked @endif>
                <label for="utang">Utang</label>
            </div>
            @error('payment_method')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>

        <div class="mb-3">
            <label for="formFile" class="form-label">Payment Proof</label>
            <input class="form-control @error('payment_proof') is-invalid @enderror" type="file" id="formFile"
                name="payment_proof">
        </div>

        <h2>Shipping Address</h2>
        <input type="text" name="shipping_address" class="form-control">

        <button type="submit" class="btn btn-success">Submit</button>
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </form>


@endsection

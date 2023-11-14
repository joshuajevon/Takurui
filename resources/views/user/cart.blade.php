@extends('template.template')

@section('head')

@endsection

@section('body')

<body class="bg-body-secondary">

    <div class=" min-vh-100">
        <div class="py-5">
            <div class="py-5 d-flex flex-column gap-5">
                <h1 class="text-center fw-bolder display-4"><span class="border-bottom border-dark border-5">My Cart</span></h1>

                <div class="container p-5 bg-light d-flex flex-column gap-4 rounded">



                    <table id="cart" class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th class="text-center">Subtotal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($carts as $cart)
                                <tr data-id="">
                                    <td data-th="Product">
                                        <div class="row">
                                            <div class="col-sm-3 hidden-xs">
                                                <img src="{{ asset('/storage/image/' . $cart->products->image) }}" width="100" height="100" class="img-responsive" />
                                            </div>
                                            <div class="col-sm-9">
                                                <h4 class="nomargin">{{ $cart->products->name }}</h4>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-th="Price">
                                        @currency($cart->price)
                                    </td>
                                    <td data-th="Quantity">
                                        <form action="{{ route('updateCartById', $cart->id) }}" method="POST">
                                            @csrf
                                            @method('patch')
                                            <input type="number" name="quantity" value="{{ $cart->quantity }}" class="form-control quantity cart_update" min="1" />
                                            <button type="submit" class="btn btn-success">
                                                Save
                                            </button>
                                        </form>
                                    </td>
                                    <td data-th="Subtotal" class="text-center">
                                        @currency( $cart->price * $cart->quantity )
                                    </td>
                                    <td class="actions" data-th="">
                                        <form action="{{ route('deleteCartById', $cart->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm cart_remove">
                                                 Delete
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
                                    <a type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">Checkout</a>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure want to checkout?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">No</button>

                                                    <a type="button" href="{{url('/payment  ')}}"
                                                        class="btn btn-success">Yes</a>
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

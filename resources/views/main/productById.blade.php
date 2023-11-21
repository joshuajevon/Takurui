@extends('template.template')

@section('head')
{{-- css js --}}

@endsection

@section('body')
<div class="pt-5">
    <div class="pt-5">
        <div class="py-5">
            <div class="container py-5 d-flex flex-column gap-4">
                <a href="/products" class="btn btn-dark d-flex justify-content-center align-items-center fw-semibold" style="width: fit-content;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
                    </svg>Go back
                </a>

                <div class="d-flex flex-column border p-lg-4 p-3 border-dark gap-lg-4 gap-0">
                    <div class="overflow-hidden d-flex justify-content-center align-items-center" style="height: 500px">
                        {{-- <img src="{{ asset('assets/temp/sample-2.png')}}" class="object-fit-contain h-100" alt="{{ $product->name }}"> --}}

                        <img src="{{asset('/storage/image/'.$product->image)}}" class="object-fit-contain h-100" alt=" product">
                    </div>

                    <div class="d-flex flex-column gap-lg-2 gap-1 mt-4">
                        <p class="fs-1 p-0 m-0 fw-bold">
                            {{$product->name}}
                        </p>

                        <p class="text-currency fs-5 p-0 m-0">
                            {{$product->category->category_name}}
                        </p>

                        <p class="fs-4 fw-medium text-currency p-0 m-0">@currency ($product->price)</p>

                        <p class="fs-5 lead mt-4">
                            {{$product->description}}
                        </p>

                        @guest
                        <select class="py-3 mt-3 form-select" aria-label="Default select example" name="size">
                            <option selected disabled>Select Size</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                            <option value="XXL">XXL</option>
                        </select>

                        {{-- Button trigger modal --}}
                        <a href="{{ route('register') }}" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-dark text-light fw-semibold p-3">
                            Add To Cart
                        </a>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Warning</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Please Register / Login before Add The Product to Cart!
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{ route('register') }}" class="btn btn-success py-lg-2 rounded text-light fw-semibold">
                                            Register
                                        </a>
                                        <a href="{{ route('login') }}" class="btn btn-primary py-lg-2 rounded text-light fw-semibold">
                                            Login
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endguest

                        @auth
                        <form action="{{route('addToCart', $product->id)}}" method="POST" class="d-flex flex-column gap-lg-2 gap-1 mt-4">
                            @csrf
                            <select class="py-3 mt-3 form-select w-100" aria-label="Default select example" name="size">
                                <option selected disabled>Select Size</option>
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                                <option value="XXL">XXL</option>
                            </select>

                            @error('size')
                            <div class="alert alert-danger m-0" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                            <button type="submit" href="{{ route('addToCart', $product->id) }}" class="btn btn-dark text-light fw-semibold p-3">Add To
                                Cart</button>

                        </form>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('template.template')

@section('head')
    {{-- css js --}}
    <style>
        .card-img-top {
            height: 250px;
            widows: 100%;
        }
        .text-currency{
            font-size: 1.75rem;
        }

        @media (max-width: 991px) {
            .card-img-top {
                max-width: 250px;
                width: 50%;
                max-height: 250px;
                height: auto;
            }
            .text-currency{
                font-size: 1.25rem;
            }
        }
    </style>
@endsection

@section('body')


<br>
<br><br><br><br><br><br><br>

{{-- All Product --}}
<div class="container d-flex flex-column gap-5 min-vh-100">
    <h1 class="text-center fw-bolder display-4"><span class="border-bottom border-dark border-5">Our
            Products</span></h1>

    @if ($products->count() == 0)
        <div class="">
            <h1>Maaf, hasil pencarian produk dengan kata kunci "{{ $result }}" belum tersedia. <a
                    href="/" class="underline text-blue-500">Klik disini</a> untuk kembali ke
                Beranda
            </h1>
        </div>
    @else
        @if ($result)
            <div class="">
                <h1>Hasil pencarian produk dengan kata kunci "{{ $result }}"</h1>
            </div>
        @endif
    @endif

    @can('isAdmin')
    <a class="text-light text-decoration-none" href="/admin/product/create-product">
            <button type="button"
                class="btn btn-primary p-lg-2 px-lg-3 px-2 p-1 d-flex justify-content-center align-items-center gap-2 fw-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                    class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                    <path
                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                </svg>Add Item
            </button>
        <
    </a>
    @endcan

    {{-- Filter --}}
    <a href="{{route('filterCat', 1)}}">Limited Edition</a>
    <a href="{{route('filterCat',2)}}">Standard</a>


    <a href="{{route('product')}}">Reset</a>
        {{-- product --}}
        <div class="row">
            @foreach ($products as $product)
            <div class="col-lg-4 col-12 p-3">
                <div
                    class="border p-lg-4 p-3 rounded border-dark d-flex align-items-center flex-column flex-row gap-lg-4 gap-2">
                    <h2 class="text-truncate d-inline-block d-lg-none w-100 text-center">Product 1</h2>
                    <div class="d-flex align-items-center flex-lg-column flex-row gap-lg-4 gap-1 w-100">
                        <img src="{{asset('/storage/image/'.$product->image)}}" class="object-fit-contain rounded card-img-top" alt="product">
                        <div class="d-flex flex-column gap-lg-2 gap-1 ps-lg-0 ps-3 w-100">
                            <h2 class="text-truncate d-lg-inline-block d-none">{{$product->name}}</h2>
                            <p class="lead d-lg-block d-none overflow-scroll overflow-x-hidden" style="height: 120px">
                                {{$product->description}}</p>
                            <h5><span
                                    class="badge bg-secondary text-light">{{$product->category->CategoryName}}</span>
                            </h5>
                            <h3 class="text-currency">@currency ($product->price)</h3>
                            <a href="{{route('productById', $product->id)}}" class="btn btn-outline-dark fw-semibold p-lg-2 p-1">View</a>
                            @guest

                            <!-- Button trigger modal -->

                            <a href="{{ route('register') }}" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                class="btn btn-dark text-light fw-semibold p-lg-2 p-1">
                                Add To Cart
                            </a>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Warning</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Please Register / Login before Add The Product to Cart!
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{ route('register') }}"
                                                class="btn btn-success py-lg-2 rounded text-center text-light fw-semibold">
                                                Register
                                            </a>
                                            <a href="{{ route('login') }}"
                                                class="btn btn-primary py-lg-2 rounded text-center text-light fw-semibold">
                                                Login
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endguest

                            @auth
                            <a href="{{ route('addToCart', $product->id) }}"
                                class="btn btn-dark text-light fw-semibold p-lg-2 p-1">Add To
                                Cart</a>
                            @endauth


                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {{ $products->links() }}

</div>
@endsection

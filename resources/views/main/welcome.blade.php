@extends('template.template')

@section('head')
@endsection

@section('body')

{{-- Hero --}}
<div>
    <div id="carouselExampleIndicators" class="carousel slide min-vh-100">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="d-flex flex-column gap-4 align-items-center justify-content-center bg-secondary vh-100">
                    <h1>Welcome to TakuRui</h1>
                    <a href="" class="btn btn-light py-2 py-sm-3 px-4 px-sm-5 text-center rounded-0">
                        <span class="fs-5">SHOP NOW</span>
                    </a>
                </div>
            </div>
            <div class="carousel-item">
                <div class="d-flex align-items-center justify-content-center bg-secondary vh-100">
                    <h1>Hello World</h1>
                </div>
            </div>
            <div class="carousel-item">
                <div class="d-flex align-items-center justify-content-center bg-secondary vh-100">
                    <h1>Hello World</h1>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

{{-- Our Latest Product --}}
<div class="py-5">
    <div class="container py-5 d-flex flex-column align-items-center">
        <h1 class="text-center display-3 w-100">LATEST PRODUCTS</h1>
        @can('isAdmin')
        <a class="text-light text-decoration-none mt-3" href="/admin/product/create-product">
            <button type="button" class="btn btn-primary p-lg-2 px-lg-3 px-2 p-1 d-flex justify-content-center align-items-center gap-2 fw-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                </svg>Add Item
            </button>
        </a>
        @endcan

        <div class="row w-100">
            {{-- Show 4 produk terbaru --}}
            @foreach ($products as $product)
            <div class="col-lg-3 col-6 pt-4">
                <div class="d-flex flex-column gap-2 gap-lg-3 w-100">
                    <div class="w-100" style="aspect-ratio: 3/4;">
                        {{-- <img src="{{ asset('assets/temp/sample-2.png')}}" class="object-fit-cover w-100 h-100" alt="{{ $product->name }}"> --}}

                        <img src="{{ asset('/storage/image/' . $product->image) }}" class="object-fit-cover w-100 h-100" alt="{{ $product->name }}">
                    </div>

                    <div class="d-flex flex-column gap-1 gap-lg-2 w-100">
                        <span class="fs-5 fs-lg-4 text-truncate fw-medium">{{ $product->name }}</span>
                        <span class="fs-6 fs-lg-5 text-break">@currency ($product->price)</span>
                    </div>

                    <div class="d-flex gap-2 w-100">
                        <a href="{{ route('productById', $product->id) }}" class="rounded-0 btn btn-outline-dark p-lg-2 p-1 w-100">View</a>
                        @guest
                        <!-- Button trigger modal -->
                        <a href="{{ route('register') }}" data-bs-toggle="modal" data-bs-target="#exampleModal" class="rounded-0 btn btn-dark rounded text-light py-lg-2 py-1 px-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z" />
                                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                            </svg>
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
                        <a href="{{ route('addToCart', $product->id) }}" class="rounded-0 btn btn-dark rounded text-light py-lg-2 py-1 px-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z" />
                                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                            </svg>
                        </a>
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <a href="/products" class="btn btn-dark py-2 py-sm-3 px-4 px-sm-5 text-center text-light mt-4 rounded-0" style="width: fit-content">SHOP ALL</a>
    </div>
</div>

{{-- Limited Edition --}}
<div class="py-5">
    <div class="container py-5 d-flex flex-column align-items-center">
        <h1 class="text-center display-3 w-100">LIMITED EDITION</h1>

        <div class="row w-100">
            @foreach ($limitedEdition as $product)
            <div class="col-lg-3 col-6 pt-4">
                <div class="d-flex flex-column gap-2 gap-lg-3 w-100">
                    <div class="w-100" style="aspect-ratio: 3/4;">
                        {{-- <img src="{{ asset('assets/temp/sample-2.png')}}" class="object-fit-cover w-100 h-100" alt="{{ $product->name }}"> --}}

                        <img src="{{ asset('/storage/image/' . $product->image) }}" class="object-fit-cover w-100 h-100" alt="{{ $product->name }}">
                    </div>

                    <div class="d-flex flex-column gap-1 gap-lg-2 w-100">
                        <span class="fs-5 fs-lg-4 text-truncate fw-medium">{{ $product->name }}</span>
                        <span class="fs-6 fs-lg-5 text-break">@currency ($product->price)</span>
                    </div>

                    <div class="d-flex gap-2 w-100">
                        <a href="{{ route('productById', $product->id) }}" class="rounded-0 btn btn-outline-dark p-lg-2 p-1 w-100">View</a>
                        @guest
                        <!-- Button trigger modal -->
                        <a href="{{ route('register') }}" data-bs-toggle="modal" data-bs-target="#exampleModal" class="rounded-0 btn btn-dark rounded text-light py-lg-2 py-1 px-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z" />
                                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                            </svg>
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
                        <a href="{{ route('addToCart', $product->id) }}" class="rounded-0 btn btn-dark rounded text-light py-lg-2 py-1 px-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z" />
                                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                            </svg>
                        </a>
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <a href="/products" class="btn btn-dark py-2 py-sm-3 px-4 px-sm-5 text-center text-light mt-4 rounded-0" style="width: fit-content">SHOP ALL</a>
    </div>
</div>

{{-- Annoucement --}}
<div class="container pb-5">
    <div class="row">
        <div class="mt-4 mt-sm-0 col-12 col-sm-6 order-2 order-sm-1">
            <div class="w-100 h-100 d-flex flex-column justify-content-center">
                <h1>The Forger's Are Back!</h1>
                <p>"Waku Waku."Anya's favorite things include peanuts, spy cartoons, cake, castles, penguins, her uniform, Mama, Papa, and Becky ♥</p>

                <a href="/products" class="btn btn-dark py-2 py-sm-3 px-4 px-sm-5 text-center text-light rounded-0" style="width: fit-content">SHOP NOW</a>
            </div>
        </div>

        <div class="col-12 col-sm-6 order-1 order-sm-2">
            <img src="{{asset('assets/home-page/spyxfamily.jpg')}}" alt="spy x family" class="w-100">
        </div>
    </div>
</div>


@endsection

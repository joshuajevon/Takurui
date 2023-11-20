@extends('template.template')

@section('head')
{{-- css js --}}
<style>
    .card-img-top {
        height: 250px;
        widows: 100%;
    }

    .text-currency {
        font-size: 1.75rem;
    }

    @media (max-width: 991px) {
        .card-img-top {
            max-width: 250px;
            width: 50%;
            max-height: 250px;
            height: auto;
        }

        .text-currency {
            font-size: 1.25rem;
        }
    }

</style>
@endsection

@section('body')
{{-- All Product --}}
<div class="pt-5">
    <div class="pt-5">
        <div class="pt-5">
            <div class="container d-flex flex-column align-items-center gap-4 gap-lg-5 min-vh-100 py-5">
                <h1 class="text-center display-3 w-100">OUR PRODUCTS</h1>

                @if ($products->count() == 0)
                <div class="">
                    <h1>Maaf, hasil pencarian produk dengan kata kunci "{{ $result }}" belum tersedia. <a href="/" class="underline text-blue-500">Klik disini</a> untuk kembali ke
                        Beranda
                    </h1>
                </div>
                @else
                @if ($result)
                <div class="" role="alert">
                    <h1>Hasil pencarian produk dengan kata kunci "{{ $result }}"</h1>
                </div>
                @endif
                @endif

                @can('isAdmin')
                <a class="text-light text-decoration-none" href="/admin/product/create-product">
                    <button type="button" class="btn btn-primary p-lg-2 px-lg-3 px-2 p-1 d-flex justify-content-center align-items-center gap-2 fw-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                        </svg>
                        Add Item
                    </button>
                </a>
                @endcan

                <div class="d-flex flex-column gap-5 align-items-center w-100">
                    <div class="d-flex flex-column w-100">
                        <h5>Filter</h5>
                        <div class="w-100">
                            <a href="{{ route('filterCat', 1) }}" class="btn {{ request()->is('products/1*') ? 'btn-dark' : 'btn-outline-dark' }}">Limited Edition</a>

                            <a href="{{ route('filterCat', 2) }}" class="btn {{ request()->is('products/2*') ? 'btn-dark' : 'btn-outline-dark' }}">Standard</a>

                            <a href="{{ route('product') }}" class="btn btn-danger">Reset</a>
                        </div>
                    </div>

                    {{-- product --}}
                    <div class="row gy-4 gy-lg-5 g-3 g-lg-4 w-100">
                        @foreach ($products as $product)
                        <div class="product-card col-lg-3 col-6">
                            <a href="{{ route('productById', $product->id) }}" class="text-decoration-none text-black">
                                <div class="d-flex flex-column gap-2 gap-lg-3 w-100">
                                    <div class="w-100 overflow-hidden" style="aspect-ratio: 3/4;">
                                        {{-- <img src="{{ asset('assets/temp/sample-2.png')}}" class="object-fit-cover w-100 h-100" alt="{{ $product->name }}"> --}}

                                        <img src="{{ asset('/storage/image/' . $product->image) }}" class="object-fit-cover w-100 h-100" alt="{{ $product->name }}">
                                    </div>

                                    <div class="d-flex flex-column gap-1 gap-lg-2 w-100">
                                        <span class="fs-5 fs-lg-4 text-truncate fw-medium">{{ $product->name }}</span>
                                        <span class="fs-6 fs-lg-5 text-break">@currency ($product->price)</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>

                    {{-- PAGINATION --}}
                    @if ($products->hasPages())
                    <nav class="d-flex justify-items-center justify-content-between w-100">
                        <div class="d-flex justify-content-between flex-fill d-sm-none">
                            <ul class="pagination">
                                {{-- Previous Page Link --}}
                                @if ($products->onFirstPage())
                                <li class="page-item disabled" aria-disabled="true">
                                    <span class="page-link">@lang('pagination.previous')</span>
                                </li>
                                @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $products->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
                                </li>
                                @endif

                                {{-- Next Page Link --}}
                                @if ($products->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $products->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
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
                                    <span class="fw-semibold">{{ $products->firstItem() }}</span>
                                    {!! __('to') !!}
                                    <span class="fw-semibold">{{ $products->lastItem() }}</span>
                                    {!! __('of') !!}
                                    <span class="fw-semibold">{{ $products->total() }}</span>
                                    {!! __('results') !!}
                                </p>
                            </div>

                            <div>
                                <ul class="pagination">
                                    {{-- Previous Page Link --}}
                                    @if ($products->onFirstPage())
                                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                                        <span class="page-link" aria-hidden="true">&lsaquo;</span>
                                    </li>
                                    @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $products->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                                    </li>
                                    @endif

                                    {{-- Next Page Link --}}
                                    @if ($products->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $products->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
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
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

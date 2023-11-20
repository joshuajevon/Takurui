@extends('template.template')

@section('head')
    {{-- css js --}}

@endsection

@section('body')

    <div class="pt-5">
        <div class="pt-5">
            <div class="pt-5">
                <div class="container min-vh-100 d-flex flex-column gap-4">
                    <nav class="nav nav-pills nav-fill">
                        <a href="/admin/product/" class="nav-link bg-dark text-light fw-semibold">Product</a>
                        <a href="/admin/product/list-dashboard/" class="nav-link fw-semibold text-dark">Payment</a>
                    </nav>

                    <a class="text-light text-decoration-none" href="/admin/product/create-category">
                        <button type="button"
                            class="btn btn-primary p-lg-2 px-lg-3 px-2 p-1 d-flex justify-content-center align-items-center gap-2 fw-semibold">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-plus-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path
                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                            </svg>Add Category
                        </button>
                    </a>

                    <a class="text-light text-decoration-none" href="/admin/product/create-product">
                        <button type="button"
                            class="btn btn-primary p-lg-2 px-lg-3 px-2 p-1 d-flex justify-content-center align-items-center gap-2 fw-semibold">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-plus-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path
                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                            </svg>Add Product
                        </button>
                    </a>

                    <table class="table table-sm table-dark table-hover table-striped text-center">
                        <thead>
                          <tr>
                            <th scope="col" class="p-2">Id</th>
                            <th scope="col" class="p-2">Product Name</th>
                            <th scope="col" class="p-2">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                              <th scope="row" class="p-2">{{$product->id}}</th>
                              <td class="p-2">{{ $product->name }}</td>
                              <td class="p-2 d-flex justify-content-center gap-2">
                                 <a href="{{ route('viewProductById', $product->id) }}" class="btn btn-primary">View</a>
                                  <a href="{{route('edit', $product->id)}}" class="btn btn-success">Edit</a>
                                  <form action="{{route('delete', $product->id)}}" method="POST" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                                  <!-- Button trigger modal -->
                                    {{-- <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Delete
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-5 text-black" id="exampleModalLabel">Delete Confirmation</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-black">
                                                Are you sure want to delete {{ $product->name }}?
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                            {{-- <form action="{{route('delete', $product->id)}}" method="POST" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger">Yes</button>
                                            </form>
                                        </div>
                                        </div>
                                    </div> --}}
                                </div>
                              </td>

                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>

@endsection

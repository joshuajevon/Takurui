@extends('template.admin-template', [$pages="products"])

@section('head')
    {{-- css js --}}

@endsection

@section('body')

    <div class="pt-3">
        <div class="pt-5">
            <div class="container min-vh-100 d-flex flex-column gap-4">
                <div class="d-flex flex-row gap-5">
                    <a href="{{ url()->previous() }}" class="btn btn-dark d-flex justify-content-center align-items-center fw-semibold" style="width: fit-content;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                        </svg>
                    </a>
                    <h1 class="text-center">View Product</h1>
                </div>
                <div class="mb-3">
                    <label for="exampleInputName" class="form-label">Name</label>
                    <input disabled value="{{$product->name}}" type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputName" name="name">
                </div>

                <div class="mb-3">
                    <label for="exampleInputName" class="form-label">Slug</label>
                    <input disabled value="{{$product->slug}}" type="text" class="form-control @error('slug') is-invalid @enderror" id="exampleInputslug" name="slug">
                </div>

                <div class="mb-3">
                  <label for="exampleInputName" class="form-label">Description</label>
                  <textarea disabled class="form-control @error('description') is-invalid @enderror" id="exampleInputName"
                  name="description" cols="30" rows="10">{{ $product->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="exampleInputStock" class="form-label">Price</label>
                    <input disabled value="@currency($product->price)" type="text"  class="form-control @error('price') is-invalid @enderror" id="exampleInputStock" name="price">
                </div>

                <div class="mb-3">
                    <label for="exampleInputAuthor" class="form-label">Stock</label>
                    <input disabled value="{{$product->stock}}" type="number"  class="form-control @error('stock') is-invalid @enderror" id="exampleInputAuthor" name="stock">
                </div>

                <div class="mb-3 d-flex flex-column gap-2">
                    <label for="formFile" class="form-label">Image</label>
                    <img src="{{ asset('/storage/image/' . $product->image) }}" style="width: 15rem" alt="{{ $product->name }}">
                </div>

                <div class="mb-3">
                    <label for="exampleInputAuthor" class="form-label">Category</label>
                    <input type="text" value="{{ $product->category->category_name }}" disabled class="form-control">
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('template.template')

@section('head')
    {{-- css js --}}

@endsection

@section('body')

    <div class="py-5">
        <div class="py-5">
            <div class="container py-5">
                <div class="d-flex flex-row gap-5">
                    <a href="{{ url()->previous() }}" class="btn btn-dark d-flex justify-content-center align-items-center fw-semibold" style="width: fit-content;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                        </svg>
                    </a>
                    <h1 class="text-center">Add Product</h1>
                </div>
                <form action="{{ route('storeProduct') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Name</label>
                        <input type="text" value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror" id="exampleInputName"
                            name="name">
                    </div>

                    @error('name')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="exampleInputName"
                        name="description" cols="30" rows="10">
                            {{ old('description') }}
                        </textarea>
                    </div>

                    @error('description')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="exampleInputStock" class="form-label">Price</label>
                        <input type="text" value="{{ old('price') }}"
                            class="form-control @error('price') is-invalid @enderror" id="exampleInputStock"
                            name="price">
                    </div>

                    @error('price')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="exampleInputAuthor" class="form-label">Stock</label>
                        <input type="number" value="{{ old('stock') }}"
                            class="form-control @error('stock') is-invalid @enderror" id="exampleInputAuthor"
                            name="stock">
                    </div>

                    @error('stock')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="formFile" class="form-label">Image</label>
                        <input class="form-control @error('image') is-invalid @enderror" type="file" id="formFile"
                            name="image">
                    </div>

                    @error('image')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="exampleInputAuthor" class="form-label">Category</label>
                        <select class="form-select" aria-label="Default select example" name="CategoryName">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>



                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

 @endsection

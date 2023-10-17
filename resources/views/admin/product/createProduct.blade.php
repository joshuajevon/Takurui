@extends('template.template')

@section('head')
    {{-- css js --}}

@endsection

@section('body')

    <div class="py-5">
        <div class="py-5">
            <div class="container py-5">
                <h1 class="text-center">Create Product</h1>
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
                        <label for="exampleInputName" class="form-label">slug</label>
                        <input type="text" value="{{ old('slug') }}"
                            class="form-control @error('slug') is-invalid @enderror" id="exampleInputName"
                            name="slug">
                    </div>

                    @error('slug')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">description</label>
                        <input type="area" value="{{ old('description') }}"
                            class="form-control @error('description') is-invalid @enderror" id="exampleInputName"
                            name="description">
                    </div>

                    @error('description')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="exampleInputStock" class="form-label">price</label>
                        <input type="text" value="{{ old('price') }}"
                            class="form-control @error('price') is-invalid @enderror" id="exampleInputStock"
                            name="price">
                    </div>

                    @error('price')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="exampleInputAuthor" class="form-label">quantity</label>
                        <input type="number" value="{{ old('quantity') }}"
                            class="form-control @error('quantity') is-invalid @enderror" id="exampleInputAuthor"
                            name="quantity">
                    </div>

                    @error('quantity')
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

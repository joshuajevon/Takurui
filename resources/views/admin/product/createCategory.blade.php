@extends('template.admin-template', [$pages="products"])

@section('head')
    {{-- css js --}}

@endsection

@section('body')

    <div class="pt-3">
        <div class="pt-5">
            <div class="container min-vh-100 d-flex flex-column gap-4">
                <div class="d-flex flex-row gap-5">
                    <a href="{{ route('adminProductDashboard') }}" class="btn btn-dark d-flex justify-content-center align-items-center fw-semibold" style="width: fit-content;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                        </svg>
                    </a>
                    <h1 class="text-center">Add Category</h1>
                </div>
                <form action="{{route('storeCategory')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                    <label for="exampleInputName" class="form-label">Category Name</label>
                    <input type="text" class="form-control @error('category_name') is-invalid @enderror" id="exampleInputName" name="category_name" value="{{old('category_name')}}">
                    </div>

                    @error('category_name')
                        <div class="alert alert-danger" role="alert">{{$message}}</div>
                    @enderror

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>


 @endsection

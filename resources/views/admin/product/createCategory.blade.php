@extends('template.template')

@section('head')
    {{-- css js --}}

@endsection

@section('body')

    <div class="py-5">
        <div class="py-5">
            <div class="container py-5">
        <h1 class="text-center">Create Category</h1>
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

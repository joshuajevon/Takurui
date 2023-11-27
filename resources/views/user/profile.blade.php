@extends('template.template')

@section('head')

@endsection

@section('body')
<div class="pt-5 bg-body-secondary">
    <div class="pt-5">
        <div class="py-5">
            <div class="py-5 container d-flex flex-column gap-4 gap-lg-5 min-vh-100">
                <div class="d-flex flex-row gap-5">
                    <a href="{{ route('dashboard')}}" class="btn btn-dark d-flex justify-content-center align-items-center fw-semibold" style="width: fit-content;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                        </svg>
                    </a>
                    <h1 class="text-center display-3 w-100">Profile</h1>
                </div>
                <div class="container min-vh-100 d-flex flex-column gap-4">
                    @if(session('success'))
                        <div class="alert alert-success m-0">
                            {{ session('success') }}
                        </div>
                        @endif
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Name</label>
                        <input disabled value="{{$user->name}}" type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputName" name="name">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Email</label>
                        <input disabled value="{{$user->email}}" type="text" class="form-control @error('email') is-invalid @enderror" id="exampleInputemail" name="email">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Phone Number</label>
                        <input disabled value="{{$user->phoneNumber}}" type="text" class="form-control @error('phoneNumber') is-invalid @enderror" id="exampleInputphoneNumber" name="phoneNumber">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputStock" class="form-label">Date Of Birth</label>
                        <input disabled value="{{$user->dob}}" type="date"  class="form-control @error('dob') is-invalid @enderror" id="exampleInputStock" name="dob">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputAuthor" class="form-label">Gender</label>
                        <input disabled value="{{$user->gender}}" type="text"  class="form-control @error('gender') is-invalid @enderror" id="exampleInputAuthor" name="gender">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputAuthor" class="form-label">Address</label>
                        <input disabled value="{{$user->address}}" type="text"  class="form-control @error('address') is-invalid @enderror" id="exampleInputAuthor" name="address">
                    </div>
                    <a href="{{ route('editProfile', $user->id) }}" class="btn btn-success">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

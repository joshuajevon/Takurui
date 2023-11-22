@extends('template.admin-template', [$pages="user"])

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
                    <h1 class="text-center">View User</h1>
                </div>
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
            </div>
        </div>
    </div>
@endsection

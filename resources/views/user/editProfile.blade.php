@extends('template.template')

@section('head')
{{-- css js --}}

@endsection

@section('body')
<div class="pt-sm-5 bg-body-secondary">
    <div class="pt-5">
        <div class="py-5">
            <div class="py-5 container d-flex flex-column gap-4 gap-lg-5 min-vh-100">
                <div class="d-flex flex-column gap-3">
                    <a href="{{ route('profile')}}" class="btn btn-dark d-flex justify-content-center align-items-center p-2 p-sm-3" style="width: fit-content;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
                        </svg>
                    </a>
                    <h1 class="text-center display-3 w-100">Edit Profile</h1>
                </div>

                <div class="container d-flex flex-column gap-4 bg-white p-4 p-sm-5 rounded">
                    <form action="{{route('updateProfile', $user->id)}}" method="POST">
                        @csrf
                        @method('patch')
                        <div class="mb-3">
                            <label for="exampleInputName" class="form-label">Name</label>
                            <input value="{{$user->name}}" type="text" class="form-control py-3 @error('name') is-invalid @enderror" id="exampleInputName" name="name">
                        </div>
                        @error('name')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror


                        <div class="mb-3">
                            <label for="exampleInputName" class="form-label">Email</label>
                            <input value="{{$user->email}}" type="email" class="form-control py-3 @error('email') is-invalid @enderror" id="exampleInputemail" name="email">
                        </div>

                        @error('email')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror

                        <div class="mb-3">
                            <label for="exampleInputName" class="form-label">Phone Number</label>
                            <input value="{{$user->phoneNumber}}" type="text" class="form-control py-3 @error('phoneNumber') is-invalid @enderror" id="exampleInputphoneNumber" name="phoneNumber">
                        </div>

                        @error('phoneNumber')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror

                        <div class="mb-3">
                            <label for="exampleInputStock" class="form-label">Date Of Birth</label>
                            <input value="{{$user->dob}}" type="date" class="form-control py-3 @error('dob') is-invalid @enderror" id="exampleInputStock" name="dob">
                        </div>

                        @error('dob')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror

                        <div class=" mb-3">
                            <label for="gender" class="col-12 col-form-label">{{ __('Gender') }}</label>

                            <div class="col-12 d-flex gap-4">
                                <div>
                                    <input type="radio" id="male" name="gender" value="male" @if ($user->gender=="male" ) checked @endif>
                                    <label for="male">Male</label>
                                </div>

                                <div>
                                    <input type="radio" id="female" name="gender" value="female" @if ($user->gender=="female" ) checked @endif>
                                    <label for="female">Female</label>
                                </div>
                            </div>
                            @error('gender')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputAuthor" class="form-label">Address</label>
                            <input value="{{$user->address}}" type="text" class="form-control py-3 @error('address') is-invalid @enderror" id="exampleInputAuthor" name="address">
                        </div>

                        @error('address')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror

                        <button type="submit" class="btn btn-primary py-3 w-100 mt-4">Save</button>
                    </form>
                </div>

                <div class="container d-flex flex-column gap-4 bg-white p-4 p-sm-5 rounded">
                    <div class="d-flex flex-row gap-5">
                        <h1 class="text-center">Change Password</h1>
                    </div>
                    <form action="{{ route('updatePassword') }}" method="POST">
                        @csrf
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @elseif (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                        @endif

                        <div class="mb-3">
                            <label for="oldPasswordInput" class="form-label">Old Password</label>
                            <input name="old_password" type="password" class="form-control py-3 @error('old_password') is-invalid @enderror" id="oldPasswordInput" placeholder="Old Password">
                            @error('old_password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="newPasswordInput" class="form-label">New Password</label>
                            <input name="new_password" type="password" class="form-control py-3 @error('new_password') is-invalid @enderror" id="newPasswordInput" placeholder="New Password">
                            @error('new_password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="confirmNewPasswordInput" class="form-label">Confirm New Password</label>
                            <input name="new_password_confirmation" type="password" class="form-control py-3" id="confirmNewPasswordInput" placeholder="Confirm New Password">
                        </div>
                        <button class="btn btn-success py-3 w-100 mt-4" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

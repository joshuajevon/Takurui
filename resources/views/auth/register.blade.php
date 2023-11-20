@extends('template.template')

@section('head')
{{-- css js --}}

@endsection

@section('body')
<div class="row p-0 m-0">
    <div id="register-container" class="pb-5 col-12 col-xl-8 d-flex flex-column px-5 overflow-y-scroll vh-100" style="padding-top: 10rem;">
        <div>
            <h1 class="fw-bold mb-4">
                {{ __('Register') }}
            </h1>
        </div>

        <div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                {{-- NAME --}}
                <div class="row mb-3">
                    <label for="name" class="col-md-12 col-form-label fw-bold">{{ __('Name') }}</label>

                    <div class="col-12">
                        <input id="name" type="text" class="py-3 rounded-0 form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Insert your name">

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                {{-- EMAIL --}}
                <div class="row mb-3">
                    <label for="email" class="col-12 col-form-label fw-bold">{{ __('Email') }}</label>

                    <div class="col-12">
                        <input id="email" type="email" class="py-3 rounded-0 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Insert your email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                {{-- PHONE NUMBER --}}
                <div class="row mb-3">
                    <label for="phoneNumber" class="col-12 col-form-label fw-bold">{{ __('Phone Number') }}</label>

                    <div class="col-12">
                        <input id="phoneNumber" type="text" class="py-3 rounded-0 form-control @error('phoneNumber') is-invalid @enderror" name="phoneNumber" value="{{ old('phoneNumber') }}" required autocomplete="phoneNumber" placeholder="Insert your phone number">

                        @error('phoneNumber')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                {{-- PASSWORD --}}
                <div class="row mb-3">
                    <label for="password" class="col-12 col-form-label fw-bold">{{ __('Password') }}</label>

                    <div class="col-12">
                        <input id="password" type="password" class="py-3 rounded-0 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Insert your password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                {{-- CONFIRM PASSWORD --}}
                <div class="row mb-3">
                    <label for="password-confirm" class="col-12 col-form-label fw-bold">{{ __('Confirm Password') }}</label>

                    <div class="col-12">
                        <input id="password-confirm" type="password" class="py-3 rounded-0 form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Insert your password">
                    </div>
                </div>

                {{-- DATE OF BIRTH --}}
                <div class="row mb-3">
                    <label for="dob" class="col-12 col-form-label fw-bold">{{ __('Date of Birth') }}</label>

                    <div class="col-12">
                        <input id="dob" type="date" class="py-3 rounded-0 form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" required autocomplete="dob" class="Insert your date of birth">

                        @error('dob')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                {{-- GENDER --}}
                <div class="row mb-3">
                    <label for="gender" class="col-12 col-form-label fw-bold">{{ __('Gender') }}</label>

                    <div class="col-12 d-flex gap-4">
                        <div>
                            <input type="radio" id="male" name="gender" value="male" @if (old('gender')=="male" ) checked @endif>
                            <label for="male">Male</label>
                        </div>

                        <div>
                            <input type="radio" id="female" name="gender" value="female" @if (old('gender')=="female" ) checked @endif>
                            <label for="female">Female</label>
                        </div>
                    </div>
                    @error('gender')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                {{-- ADDRESS --}}
                <div class="row mb-3">
                    <label for="address" class="col-12 col-form-label fw-bold">{{ __('Address') }}</label>

                    <div class="col-12">
                        <input id="address" class="py-3 rounded-0 form-control @error('adress') is-invalid @enderror" type="text" name="address" :value="old('address')" required autofocus autocomplete="address" placeholder="Insert your address" />

                        @error('adress')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <button type="submit" class="btn btn-dark py-2 py-sm-3 px-4 px-sm-5 mt-4 text-center text-light rounded-0">
                            {{ __('REGISTER') }}
                        </button>
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-12">
                        <p class="m-0">Already have an account?
                            <a href="/login" class="fw-bold text-decoration-none text-black">Login here.</a>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="pt-5 d-none d-xl-flex col-lg-4 bg-secondary-subtle align-items-end">
        <div class="pt-5">
            <div class="pt-5">
                <div class="pt-5">
                    <img src="{{asset('assets/common/mascot.png')}}" alt="TakuRui mascot" class="object-contain w-100" style=" -webkit-transform: scaleX(-1);
                    transform: scaleX(-1);">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the scrollable container
        var scrollContainer = document.getElementById('register-container');

        // Set the scroll position to the top
        scrollContainer.scrollTop = 0;
    });

</script>
@endsection

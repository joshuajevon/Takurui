@extends('template.template')

@section('head')
{{-- css js --}}

@endsection

@section('body')
<div class="row p-0 m-0">
    <div class="pt-5 d-none d-xl-flex col-lg-4 bg-secondary-subtle align-items-end">
        <div class="pt-5">
            <div class="pt-5">
                <div class="pt-5">
                    <img src="{{asset('assets/common/mascot.png')}}" alt="TakuRui mascot" class="object-contain w-100">
                </div>
            </div>
        </div>
    </div>

    <div class="pb-5 col-12 col-xl-8 d-flex flex-column justify-content-center px-5 vh-100" style="padding-top: 10rem;">
        <div>
            <h1 class="fw-bold mb-4">
                {{ __('Login') }}
            </h1>
        </div>

        <div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
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

                <div class="row mb-3">
                    <label for="password" class="col-12 col-form-label fw-bold">{{ __('Password') }}</label>

                    <div class="col-12">
                        <input id="password" type="password" class="py-3 rounded-0 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Insert your password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        @if (Route::has('password.request'))
                        <div class="d-flex justify-content-end mt-2">
                            <a class="text-decoration-none text-black text-end" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <button type="submit" class="btn btn-dark py-2 py-sm-3 px-4 px-sm-5 text-center text-light rounded-0">
                            {{ __('LOGIN') }}
                        </button>
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-12">
                        <p class="m-0">Don't have an account?
                            <a href="/register" class="fw-bold text-decoration-none text-black">Register here.</a>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

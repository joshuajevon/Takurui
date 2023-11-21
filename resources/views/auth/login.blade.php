<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Takurui</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    {{-- GOOGLE FONT --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    {{-- CUSTOM CSS --}}
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    @yield('head')
</head>
<body>
    <div class="row p-0 m-0">
        <div class="pt-5 d-none d-xl-flex col-lg-4 bg-secondary-subtle align-items-end">
            <div class="pt-5">
                <div class="pt-5">
                    <div class="pt-5">
                        <a href="/">
                            <img src="{{asset('assets/common/mascot.png')}}" alt="TakuRui mascot" class="object-contain w-100">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-5 col-12 col-xl-8 d-flex flex-column justify-content-center px-5 vh-100">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

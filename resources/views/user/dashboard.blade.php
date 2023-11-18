@extends('template.template')

@section('head')

@endsection


@section('body')

<br><br><br><br><br><br>
    <h1>ini dashboard</h1>



    @if(auth()->user()->isAdmin)
        <p>Welcome, Admin!</p>
        <a href="{{ route('adminProductDashboard') }}">Admin Dashboard</a>
    @else
        <p>Welcome, User!</p>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
    @endif

    <a href="{{route('profile')}}">Profile</a>
        <br>
    <a href="{{route('myorder')}}">My Order</a>

    <form class="" action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn text-danger p-0">Logout</button>
    </form>


@endsection

@extends('template.template')

@section('head')

@endsection


@section('body')
    <h1>ini dashboard</h1>



    @if(auth()->user()->isAdmin)
        <p>Welcome, Admin!</p>
        <a href="{{ route('adminProductDashboard') }}">Admin Dashboard</a>
    @else
        <p>Welcome, User!</p>

        List Order:
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
    @endif

@endsection

@extends('template.template')

@section('head')

@endsection


@section('body')
<div class="pt-5 bg-body-secondary">
    <div class="pt-5">
        <div class="py-5">
            <div class="py-5 container d-flex flex-column gap-4 gap-lg-5 min-vh-100">
                <h1 class="text-center display-3 w-100">DASHBOARD</h1>

                <div class="d-flex flex-column gap-3">
                    @if(auth()->user()->isAdmin)
                    <div class="alert alert-primary m-0" role="alert">
                        <p class="fs-6 m-0">Welcome, Admin!</p>
                    </div>

                    @else
                    <div class="alert alert-primary m-0" role="alert">
                        <p class="fs-6 m-0">Welcome, User!</p>
                    </div>

                    @if(session('success'))
                    <div class="alert alert-success m-0">
                        {{ session('success') }}
                    </div>
                    @endif
                    @endif
                </div>

                <div class="list-group">
                    @if(auth()->user()->isAdmin)
                    <a href="{{ route('adminProductDashboard') }}" class="list-group-item list-group-item-action py-3">Admin Dashboard</a>
                    @endif
                    <a href="{{route('profile')}}" class="list-group-item list-group-item-action py-3">Profile</a>
                    <a href="{{route('myorder')}}" class="list-group-item list-group-item-action py-3">My Order</a>
                    <form class="list-group-item list-group-item-action py-3 bg-danger-subtle" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn text-danger p-0">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

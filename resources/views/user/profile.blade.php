@extends('template.template')

@section('head')

@endsection

@section('body')
<div class="pt-5 bg-body-secondary">
    <div class="pt-5">
        <div class="py-5">
            <div class="py-5 container d-flex flex-column gap-4 gap-lg-5 min-vh-100">
                <h1 class="text-center display-3 w-100">Profile</h1>

                <h2>Name: {{$user->name}}</h2>
                <h2>Email: {{$user->email}}</h2>
                <h2>Phone Number: {{$user->phoneNumber}}</h2>
                <h2>DOB: {{$user->dob}}</h2>
                <h2>Gender: {{$user->gender}}</h2>
                <h2>Address: {{$user->address}}</h2>
            </div>
        </div>
    </div>
</div>
@endsection

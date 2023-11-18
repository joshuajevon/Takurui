@extends('template.template')

@section('head')

@endsection

@section('body')
<br><br><br><br><br>
    <h1>Profile</h1>
    <h2>Name: {{$user->name}}</h2>
    <h2>Email: {{$user->email}}</h2>
    <h2>Phone Number: {{$user->phoneNumber}}</h2>
    <h2>DOB: {{$user->dob}}</h2>
    <h2>Gender: {{$user->gender}}</h2>
    <h2>Address: {{$user->address}}</h2>
@endsection

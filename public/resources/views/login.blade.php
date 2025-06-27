@extends('layouts.app-public')

@section('title', 'Login')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Login</h2>
    <form method="POST" action="{{ url('/api/login') }}" id="loginForm">
        @csrf
        <div class="form-group mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required />
        </div>
        <div class="form-group mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required />
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
@endsection

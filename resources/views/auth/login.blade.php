@extends('frontend.layout')
@section('title', 'Login')
@section('content')
<div style="max-width: 550px;margin:20px auto">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-center mb-0">
                Login
            </h3>
        </div>
        <div class="card-body">
            <x-alert-new />

            <form action="{{ route('login') }}" method="post">
                @csrf

                <x-form
                    text="Email Address"
                    type="email"
                    field="email"
                    :required="true"
                />

                <x-form
                    text="Password"
                    type="password"
                    field="password"
                    :required="true"
                />

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" checked>
                    <label class="form-check-label" for="remember">
                        Remember Me
                    </label>
                </div>


                <button class="btn btn-primary btn-lg">
                    Log In
                </button>

            </form>
        </div>
        <div class="card-footer">
            New? <a href="{{ route('register') }}">Create New Account</a>
        </div>
    </div>
</div>
@endsection
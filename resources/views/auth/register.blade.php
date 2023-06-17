@extends('frontend.layout')
@section('title', 'Create New Account')
@section('content')
<div style="max-width: 550px;margin:20px auto">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title text-center mb-0">
                Create New Account
            </h4>
        </div>
        <div class="card-body">
            <x-alert-new />

            <form action="{{ route('register') }}" method="post">
                @csrf

                <x-form
                    text="Full Name"
                    field="name"
                    :required="true"
                />

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

                <x-form
                    text="Confirm Password"
                    type="password"
                    field="password_confirmation"
                    :required="true"
                />

                <button class="btn btn-primary btn-lg">
                    Register
                </button>

            </form>
        </div>
        <div class="card-footer">
            Already have an account? <a href="{{ route('login') }}">Log In</a>
        </div>
    </div>
</div>
@endsection
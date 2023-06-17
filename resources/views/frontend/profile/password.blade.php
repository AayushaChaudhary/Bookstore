@extends('frontend.layout')

@section('title', 'Update Password')

@section('content')
    <div class="container py-4" style="max-width: 1000px">
        <x-alert-new />

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title text-center mb-0">Change Password</h5>
                    <a class="btn btn-primary" href="{{ route('profile.index') }}">
                        &larr;
                        Back to My Profile
                    </a>
                </div>
            </div>
            <div class="card-body">

                <form action="{{ route('profile.password.update') }}" method="post">
                    @method("PUT")
                    @csrf

                    <x-form
                        text="Current Password"
                        field="current_password"
                        type="password"
                        :old="false"
                    />

                    <x-form
                        text="New Password"
                        field="password"
                        type="password"
                        :old="false"
                    />

                    <x-form
                        text="Confirm New Password"
                        field="password_confirmation"
                        type="password"
                        :old="false"
                    />

                    <button type="submit" class="btn btn-primary mt-3">
                        Change Password
                    </button>
                </form>


            </div>
    </div>
</div>
@endsection

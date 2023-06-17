@extends('frontend.layout')

@section('title', 'Update Profile')

@section('content')
    <div class="container py-4" style="max-width: 1000px">
        <x-alert-new />

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title text-center mb-0">Edit Profile</h5>
                    <a class="btn btn-primary" href="{{ route('profile.index') }}">
                        &larr;
                        Back to My Profile
                    </a>
                </div>
            </div>
            <div class="card-body">

                <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                    @method("PUT")
                    @csrf

                    <x-form
                        text="Full Name"
                        field="name"
                        :current="$user->name"
                    />

                    <x-form
                        text="Email Address"
                        field="email"
                        type="email"
                        :current="$user->email"
                    />

                    {{-- <x-form
                        text="Profile Picture"
                        field="image"
                        type="file"
                    /> --}}

                    @if($user->media_id && $user->media)
                    <div style="display:inline-block" class="bg-light p-4">
                        Current: <br><br> <img src="{{ $user->photo }}" height="50px" />
                    </div>
                    @endif

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">
                            Update Profile
                        </button>
                    </div>
                </form>


            </div>
    </div>
</div>
@endsection

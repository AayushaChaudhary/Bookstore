@extends('user.layout')

@section('title', 'user.dashboard')

@section('content')

<div class="card">
    <div class="card-body">
        Welcome {{ auth()->user()->name }}
    </div>
    
</div>
    
@endsection
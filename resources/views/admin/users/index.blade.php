@extends('adminlte::page')
@section('title','All Users')
@section('content')
<x-alert />

<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="font-size:1.3rem;line-height:1.8;
        font-weight:bold">
            All Users
        </h3>
        {{-- <div class="card-tools">
            <a class="btn btn-primary" href="{{ route('admin.users.create') }}">
            <i class="fas fa-plus-circle mr-2"></i>
                Add New
            </a>
        </div> --}}
    </div>

    <div class="card-body p-0">
        <table class="table table-bordered">
           <thead class="bg-primary">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Registered</th>
        </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }} </td>
                <td>{{ $user->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</div>
@endsection
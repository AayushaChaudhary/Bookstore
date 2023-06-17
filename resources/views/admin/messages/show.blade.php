@extends('adminlte::page')

@section('title', 'User Messages')

@section('content')

<x-alert />

<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="font-size: 1.5rem;line-height:1.8;font-weight:bold">
            Message Details
        </h3>
        <div class="card-tools">
            <a class="btn btn-primary" href="{{route('admin.messages.index')}}">
            <i class="fas fa-arrow-circle-left mr-2"></i>
                Go Back
            </a>
        </div>
    </div>

      <div class="card-body p-0">
          <table class="table table-bordered m-0">
            <tr>
                <th>ID</th>
                <td>{{ $message->id }}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $message->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $message->email }}</td>
            </tr>
            <tr>
                <th>Message</th>
                <td>{{ $message->message }}</td>
            </tr>
            <tr>
                <th>Created</th>
                <td>{{ $message->created_at }}</td>
            </tr>
            <tr>
                <th>Updated</th>
                <td>{{ $message->updated_at }}</td>
            </tr>
          </table>
      </div>
</div>

@endsection
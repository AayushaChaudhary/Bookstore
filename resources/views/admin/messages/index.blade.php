@extends('adminlte::page')

@section('title', 'User Messages')

@section('content')

<x-alert />

<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="font-size: 1.5rem;line-height:1.8;font-weight:bold">
            User Messages
        </h3>
    </div>

      <div class="card-body p-0">
          <table class="table table-bordered table-striped">
              <thead class="bg-primary">
                  <tr>
                      <th style="width: 70px">SN</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Messages</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($messages as $message)
                  <tr>
                    <td>{{ $message->id }}</td>
                    <td>{{ $message->name }}</td>
                    <td>{{ $message->email }}</td>
                    <td>{{ \Str::limit($message->message, 100) }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.messages.show', $message) }}">
                        <i class="fas fa-eye mr-2"></i>
                        Details
                        </a>
                    </td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
</div>

@endsection
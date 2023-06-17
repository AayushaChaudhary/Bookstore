@extends('adminlte::page')
@section('title','All Orders')

@section('content')

<x-alert />

<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="font-size:1.3rem;line-height:1.8;
        font-weight:bold">
        All Orders</h3>
        <div class="card-tools">
            <a class="btn btn-primary" href="{{ route('admin.orders.create') }}">
            <i class="fas fa-plus-circle mr-2"></i>
                Add New
            </a>
        </div>
    </div>

    <div class="card-body p-0">
        <table class="table table-bordered">
           <thead class="bg-primary">
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Status</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->created_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{route('admin.orders.show', $order)}}">
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
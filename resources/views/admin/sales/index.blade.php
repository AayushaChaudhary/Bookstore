@extends('adminlte::page')
@section('title','All Sales')

@section('content')

<x-alert />

<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="font-size:1.3rem;line-height:1.8;
        font-weight:bold">
            All Sales
        </h3>

    </div>

    <div class="card-body p-0">
        <table class="table table-bordered">
           <thead class="bg-primary">
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Amount</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
            @foreach($sales as $sale)
            <tr>
                <td>{{ $sale->id }}</td>
                <td>{{ $sale->user->name }}</td>
                <td>Rs. {{ $sale->total_amount }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{route('admin.sales.show', $sale)}}">
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
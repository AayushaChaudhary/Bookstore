@extends('adminlte::page')

@section('content')
@section('title','Book Stock History')
@section('content')
<x-alert />

<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="font-size:1.3rem;line-height:1.8;
        font-weight:bold">
            Book Stock History
        </h3>
         <div class="card-tools">
            <a class="btn btn-primary" href="{{ route('admin.stocks.create') }}">
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
            <th>Book</th>
            <th>Type</th>
            <th>Quantity</th>
            <th>Remarks</th>
        </tr>
        </thead>
        <tbody>
            @foreach($stocks as $stock)
            <tr>
                <td>{{ $loop->index+1 }}</td>
                <td>{{ $stock->book->name }}</td>
                <td>{{ $stock->quantity <= 0 ? "Outgoing" : "Incoming" }}</td>
                <td>{{ abs($stock->quantity) }}</td>
                <td>{{ $stock->remarks }}</td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</div>
@endsection
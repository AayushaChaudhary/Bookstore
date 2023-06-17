@extends('adminlte::page')
@section('title','Add New Order')

@section('content')

<x-alert />

<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="font-size:1.3rem;line-height:1.8;
        font-weight:bold">
            Update Quantity
        </h3>
        <div class="card-tools">
            <a class="btn btn-primary" href="{{ route('admin.orders.show', $order) }}">
            <i class="fas fa-arrow-circle-left mr-2"></i>
                Go Back
            </a>
        </div>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.orders.books.quantity', [$order, $book_order]) }}" method="post">
        @csrf

        <div class="form-group">
            <label>Book</label>
            <input type="text" disabled value="{{ $book_order->book->name }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" min="0" value="{{ old('quantity') ?? $book_order->quantity ?? 1 }}" name="quantity" id="quantity" class="form-control">
        </div>

        <button class="btn btn-primary">
            <i class="fas fa-save mr-2"></i>
            Update Quantity
        </button>
        </form>
    </div>
</div>

@endsection
@extends('adminlte::page')

@section('title', 'Purchase Details')

@section('content')

<x-alert />

<div class="card">
    <div class="card-header">

        <h3 class="card-title" style="font-size: 1.5rem;line-height:1.8;font-weight:bold">
            Purchase Details
        </h3>

        <div class="card-tools">
            <a class="btn btn-primary" href="{{ route('admin.purchases.index') }}">
                <i class="fas fa-arrow-circle-left mr-2"></i>
                Go Back
            </a>
        </div>

    </div>

      <div class="card-body p-0">
          <table class="table table-bordered table-striped">
              <tr>
                  <th style="width: 20%">ID</th>
                  <td>{{ $purchase->id }}</td>

              </tr>
              <tr>
                <th>Book</th>
                <td>{{ $purchase->book->name }}</td>

            </tr>

            <tr>
                <th>Supplier</th>
                <td>{{ $purchase->supplier->name }}</td>

            </tr>
            <tr>
                <th>Quantity</th>
                <td>{{ $purchase->quantity }}</td>

            </tr>
            <tr>
                <th>Unit Price</th>
                <td>Rs. {{ $purchase->price }}</td>
            </tr>
            <tr>
                <th>Total Price</th>
                <td>Rs. {{ $purchase->total }}</td>
            </tr>
            <tr>
                <th>Created</th>
                <td>{{ $purchase->created_at }}</td>

            </tr>
            <tr>
                <th>Updated</th>
                <td>{{ $purchase->updated_at }}</td>

            </tr>
          </table>

      </div>

</div>

@endsection
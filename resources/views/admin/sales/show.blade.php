@extends('adminlte::page')

@section('title', 'Sales Details')

@section('content')

<x-alert />

<div class="card">
    <div class="card-header">

        <h3 class="card-title" style="font-size: 1.5rem;line-height:1.8;font-weight:bold">
            Sales Details
        </h3>

        <div class="card-tools">
            <a class="btn btn-primary" href="{{ route('admin.sales.index') }}">
                <i class="fas fa-arrow-circle-left mr-2"></i>
                Go Back
            </a>
        </div>

    </div>

      <div class="card-body p-0">
          <table class="table table-bordered table-striped">
              <tr>
                  <th style="width: 20%">ID</th>
                  <td>{{ $sale->id }}</td>

              </tr>
              <tr>
                <th>User</th>
                <td>{{ $sale->user->name }}</td>

            </tr>

            <tr>
                <th>Amount</th>
                <td>{{ $sale->total_amount}}</td>

            </tr>
           
            <tr>
                <th>Created</th>
                <td>{{ $sale->created_at }}</td>

            </tr>
            <tr>
                <th>Updated</th>
                <td>{{ $sale->updated_at }}</td>

            </tr>
          </table>

      </div>

</div>

@endsection
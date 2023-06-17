@extends('adminlte::page')

@section('title', 'Supplier Details')

@section('content')

<x-alert />

<div class="card">
    <div class="card-header">

        <h3 class="card-title" style="font-size: 1.5rem;line-height:1.8;font-weight:bold">
            Supplier Details
        </h3>

        <div class="card-tools">
            <a class="btn btn-primary" href="{{ route('admin.suppliers.index') }}">
                <i class="fas fa-arrow-circle-left mr-2"></i>
                Go Back
            </a>
        </div>

    </div>

      <div class="card-body p-0">
          <table class="table table-bordered table-striped">
            <tr>
                <th style="width: 20%">ID</th>
                <td>{{ $supplier->id }}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $supplier->name }}</td>
            </tr>
            <tr>
                <th>Phone</th>
                <td>{{ $supplier->phone }}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>{{ $supplier->address }}</td>
            </tr>
            <tr>
                <th>Photo</th>
                <td> @if ($supplier->media)
                    <img src="/storage/{{ $supplier->media->path }}" height="70px" />
                @endif
                </td>
            </tr>
            <tr>
                <th>Purchases</th>
                <td>
                    @if (count($supplier->purchases)>0)
                      <ul>
                    @foreach ($supplier->purchases as $item )
                    <li>
                        {{ $item->book->name }} / Quantity: {{ $item->quantity }}
                        / Unit price: Rs. {{ $item->price }} 
                        / Total: Rs. {{ $item->quantity * $item->price }}
                    </li>
                    @endforeach      
                    </ul>
                    @else
                    No purchases found!  
                    @endif
                </td>
            </tr>
            <tr>
                <th>Created</th>
                <td>{{ $supplier->created_at }}</td>
            </tr>
            <tr>
                <th>Updated</th>
                <td>{{ $supplier->updated_at }}</td>
            </tr>
          </table>
      </div>
</div>

@endsection
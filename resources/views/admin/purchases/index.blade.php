@extends('adminlte::page')
@section('title','All Purchasess')

@section('content')

<x-alert />

<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="font-size:1.3rem;line-height:1.8;
        font-weight:bold">
            All Purchases
        </h3>
        <div class="card-tools">
            <a class="btn btn-primary" href="{{ route('admin.purchases.create') }}">
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
                    <th>Supplier</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($purchases as $purchase)
                <tr>
                    <td>{{ $purchase->id }}</td>
                    <td>{{ $purchase->book->name }}</td>
                    <td>{{ $purchase->supplier->name }}</td>
                    <td>Rs. {{ $purchase->price }}</td>
                    <td>{{ $purchase->quantity }}</td>
                    <td>Rs. {{ $purchase->total }}</td>
                    <td>{{ $purchase->created_at }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{route('admin.purchases.show',$purchase)}}">
                            <i class="fas fa-eye mr-2"></i>
                            Show
                        </a>

                        {{-- <a class="btn btn-primary btn-sm" href="{{route('admin.purchases.edit',$purchase)}}">
                            <i class="fas fa-edit mr-2"></i>
                            Edit
                        </a> --}}

                        {{-- <form class="d-inline" action="{{ route('admin.purchases.destroy', $purchase) }}" --}}
                        {{-- method="post"> --}}
                            {{-- @csrf --}}
                            {{-- @method('DELETE') --}}

                            {{-- <button class="btn btn-danger btn-sm"> --}}
                                {{-- <i class="fas fa-trash mr-2"></i> --}}
                                {{-- Delete --}}
                            {{-- </button> --}}
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
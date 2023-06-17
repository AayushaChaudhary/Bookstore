@extends('adminlte::page')
@section('title','Order Details')
@section('plugins.Select2',true)
@section('js')
<script>
    $(document).ready(function(){
        $('#status').select2();
        $('#book_id').select2();
    });

    function customerInfo() {
        $('#customer-info').toggle();
    }
</script>
@endsection

@section('content')

<x-alert />

<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="font-size:1.3rem;line-height:1.8;font-weight:bold">
            Order Details
        </h3>
        <div class="card-tools">

            <button onclick="customerInfo()" class="btn btn-secondary mr-2">
                Customer Information
            </button>

            <form class="block-margin mr-3" style="display: inline-block!important;" action="{{ route('admin.orders.status', $order) }}" method="post">
                @csrf
                <div class="input-group">
                    <x-input
                    type="select"
                    field="status"
                    text=""
                    :options="\App\Models\Order::STATUS"
                    key=""
                    :current="$order->status"
                    :error="false"
                />
                <div class="input-group-append">
                    <button type="submit" class="btn btn-info">Update</button>
                </div>
                </div>

            </form>

            <a class="btn btn-primary" href="{{ route('admin.orders.index') }}">
            <i class="fas fa-arrow-circle-left mr-2"></i>
                Go Back
            </a>
        </div>
    </div>

    <div class="card-footer p-0" style="display:none" id="customer-info">
        <table class="table m-0 table-bordered">
            <tr>
                <th style="width: 10%">Customer</th>
                <td colspan="2">{{ $order->user?->name }}</td>
            </tr>
        </table>
        <table class="table table-bordered m-0">
            <thead class="thead-dark">
                <tr>
                    <th style="width: 10%"></th>
                    <th>
                        <h5>Billing Information</h5>
                    </th>
                    <th>
                        <h5>Shipping Information</h5>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Name:</th>
                    <td>{{ $order->billing_name }}</td>
                    <td>{{ $order->shipping_name }}</td>
                </tr>
                <tr>
                    <th>Address:</th>
                    <td>{{ $order->billing_address }}</td>
                    <td>{{ $order->shipping_address }}</td>
                </tr>
                <tr>
                    <th>Phone:</th>
                    <td>{{ $order->billing_phone }}</td>
                    <td>{{ $order->shipping_phone }}</td>
                </tr>
                <tr>
                    <th>Notes:</th>
                    <td>{{ $order->billing_notes }}</td>
                    <td>{{ $order->shipping_note }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    @if($order->can_update)
    <div class="card-body">
        <form action="{{ route('admin.orders.books.store', $order) }}" method="post">
            @csrf

            <div class="row">
                <div class="col-md-7">
                    <x-input
                        type="select"
                        field="book_id"
                        text="Book"
                        :options="$books"
                    />
                </div>
                <div class="col-md-3">
                    <x-input
                        type="number"
                        field="quantity"
                        text="Quantity"
                        :current="old('quantity') ?? 1"
                    />
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">&nbsp;</label><br>
                        <button type="submit" class="btn btn-primary">
                            Add Book
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @else
    <div class="card-footer">
        <div class="alert alert-warning mb-0 text-center">
            This order has been marked as {{ $order->status }}. No further modification can be made!
        </div>
    </div>
    @endif


    <div class="card-body p-0">
        <table class="table table-bordered">
            <thead class="bg-primary">
                <tr>
                    <th>S.N</th>
                    <th>Book</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                    @if($order->can_update)
                    <th>Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($book_orders as $bo)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $bo->book->name }}</td>
                    <td>{{ $bo->quantity }}</td>
                    <td>Rs. {{ $bo->unit_price }}</td>
                    <td>Rs. {{ $bo->quantity * $bo->unit_price }}</td>
                    @if($order->can_update)
                    <td>
                        <a class="btn btn-sm btn-primary" href="{{ route('admin.orders.books.quantity', [$order, $bo]) }}">
                            <i class="fas fa-fw fa-edit mr-2"></i>
                            Qty
                        </a>
                        <a class="btn btn-sm btn-danger" href="{{ route('admin.orders.books.delete', [$order, $bo]) }}">
                            <i class="fas fa-fw fa-trash"></i>
                        </a>
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center">
                        There are no books added to this order. Please add some from above and it will appear here!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
    .block-margin .form-group {
        margin-bottom: 0!important;
    }
</style>
@endsection
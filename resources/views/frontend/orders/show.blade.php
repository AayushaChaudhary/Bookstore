@extends('frontend.layout')

@section('title', 'Order Details')

@section('content')
    <div class="container py-4">
        <x-alert-new />

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title text-center mb-0">Order Details</h5>
                    <a class="btn btn-primary" href="{{ route('profile.orders') }}">
                        &larr;
                        Back to My Orders List
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 15%px">ID</th>
                        <td>{{ $order->id }}</td>
                    </tr>
                    <tr>
                        <th>Products</th>
                        <td class="p-0">
                            @if($order->bookOrders)
                            <table class="table m-0" style="box-shadow: none!important;">
                                <thead>
                                    <tr>
                                        <td>Book</td>
                                        <td>Unit Price</td>
                                        <td>Quantity</td>
                                    </tr>
                                </thead>
                                @foreach($order->bookOrders as $item)
                                <tr>
                                    <td>
                                        <a href="{{ route('book', $item->book) }}">
                                            {{ $item->book->name }}
                                        </a>
                                    </td>
                                    <td>Rs. {{ $item->unit_price }}</td>
                                    <td>{{ $item->quantity }}</td>
                                </tr>
                                @endforeach
                            </table>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Total Amount</th>
                        <td>Rs. {{ $order->total }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td><b>{{ $order->status }}</b></td>
                    </tr>
                    <tr>
                        <th>Last Update</th>
                        <td>{{ $order->updated_at->format('Y/m/d H:i:s A') }}</td>
                    </tr>
                    <tr>
                        <th>Order Placed</th>
                        <td>{{ $order->created_at->format('Y/m/d H:i:s A') }}</td>
                    </tr>
                    @if($order->can_cancel)
                    <tr>
                        <td>Action</td>
                        <td>
                            <div class="mt-2">
                                <a href="#" onclick="confirmCancel({{ $order->id }})" class="btn btn-danger btn-sm d-inline-flex align-items-center">
                                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                        </svg>
                                    Cancel Order
                                </a>
                            </div>

                            <form id="cancel-{{ $order->id }}" action="{{ route('profile.order.cancel', $order) }}" method="post">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endif
            </table>
        </div>
    </div>
</div>

<script>
    function confirmCancel(id) {
        if(confirm('Are you sure you want to cancel this order?')) {
            document.getElementById('cancel-' + id).submit();
        }
    }
</script>
@endsection
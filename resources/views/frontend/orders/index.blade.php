@extends('frontend.layout')

@section('title', 'My Orders')

@section('content')
    <div class="container py-4">
        <x-alert-new />

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title text-center mb-0">My Orders</h5>
                    <a class="btn btn-primary" href="{{ route('profile.index') }}">
                        &larr;
                        Back to My Profile
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 40px">ID</th>
                            <th>Products</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Placed</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @forelse($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td class="p-0">
                            @if(count($order->bookOrders) > 0)
                            <table class="table m-0 table-bordered" style="box-shadow: none!important;">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Unit Price</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                </tbody>
                            </table>
                            @endif
                        </td>
                        <td>Rs. {{ $order->total }}</td>
                        <td><b>{{ $order->status }}</b></td>
                        <td>{{ $order->created_at->format('Y/m/d H:i:s A') }}</td>
                        <td>
                            <a href="{{ route('profile.order', $order) }}" class="btn btn-primary btn-sm d-inline-flex align-items-center">
                                <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                  </svg>
                                View More
                            </a>

                            @if($order->can_cancel)
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
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align: center">You do not have any order placed!</td>
                    </tr>
                    @endforelse
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
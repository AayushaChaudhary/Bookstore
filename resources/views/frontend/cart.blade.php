@extends('frontend.layout')

@section('title', 'Cart')

@section('content')
<div class="container my-4 py-4">
    <h3 class="text-center mb-5">Cart</h3>

    <x-alert-new />

<div class="card" style="overflow: hidden">
    <div class="card-body p-0">
        <table class="table table-striped table-bordered m-0">
            <thead class="bg-primary text-white">
                <tr>
                    <th>SN</th>
                    <th>Book</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @if(count($carts) > 0)
                @foreach($carts as $item)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>
                        <a href="{{ route('book', $item->book_id) }}">
                            {{ $item->book->name }}
                        </a>
                    </td>
                    <td>
                        <div class="d-flex">
                            <form method="POST" action="{{ route('cart.quantity', $item) }}">
                                @csrf
                                <div class="input-group">
                                    <input type="number" value="{{ $item->quantity }}" style="width: 100px!important" class="form-control form-control-sm" name="quantity">
                                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                </div>
                            </form>
                        </div>
                    </td>
                    <td>
                        Rs. {{ $item->book->current_amount }}
                    </td>
                    <td>
                        @php
                            $current_total = $item->book->current_amount * $item->quantity;
                            $total += $current_total;
                        @endphp

                        Rs. {{ $current_total }}
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $item->id }})">
                            Remove
                        </button>
                        <form id="delete-form-{{ $item->id }}" action="{{ route('cart.remove', $item) }}" method="post">
                            @csrf
                        </form>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td style="text-align: right" colspan="4"><b>Total</b></td>
                    <td colspan="2"><b>Rs. {{ $total }}</b></td>
                </tr>
                @else
                <tr>
                    <td class="text-center" colspan="6">Your cart is empty!</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-end px-1 mt-4">
    @if(count($carts) > 0)
    <a class="btn btn-primary btn-lg" href="{{ route('checkout.index') }}">
        Checkout
    </a>
    @else
        <button type="button" disabled class="btn btn-primary btn-lg">
            Checkout
        </button>
    @endif
</div>

</div>

<script>
    function confirmDelete(id) {
        if(confirm('Are you sure you want to remove this item from cart?')) {
            document.getElementById('delete-form-' + id).submit();
        }
        return;
    }
</script>
@endsection

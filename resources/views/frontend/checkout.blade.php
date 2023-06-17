@extends('frontend.layout')

@section('title', 'Checkout')

@section('content')
<div class="container my-4 py-4">
<h3 class="text-center mb-5">Checkout</h3>
<x-alert-new />

<h4 class="mb-2">Review Your Cart</h4>
<div class="card">
    <div class="card-body p-0">
        <table class="table table-striped m-0">
            <thead class="bg-primary text-white">
                <tr>
                    <th>SN</th>
                    <th>Book</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
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
                            <b>{{ $item->quantity }}</b>
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
                </tr>
                @endforeach
                <tr>
                    <td style="text-align: right" colspan="4"><b>Total</b></td>
                    <td><b>Rs. {{ $total }}</b></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="card card-body my-3 text-center">
    Please fill this form to continue with your order.
</div>

<form action="{{ route('checkout.store') }}" method="post">
    @csrf

    <div class="row">
        <div class="col-12 col-md-6">
            <h4 class="my-3 font-bold">Shipping Details</h4>
            <div class="card">
                <div class="card-body">
                    <x-form
                        field="shipping_name"
                        :required="true"
                        text="Full Name"
                    />

                    <x-form
                        field="shipping_address"
                        :required="true"
                        text="Address"
                    />

                    <x-form
                        field="shipping_phone"
                        :required="true"
                        text="Phone Number"
                    />

                    <x-form
                        field="shipping_notes"
                        type="textarea"
                        text="Additional Notes for Shipping"
                    />
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <h4 class="my-3 font-bold">Billing Details</h4>
            <div class="card">
                <div class="card-body">
                    <x-form
                        field="billing_name"
                        :fake_required="true"
                        text="Full Name"
                    />

                    <x-form
                        field="billing_address"
                        :fake_required="true"
                        text="Address"
                    />

                    <x-form
                        field="billing_phone"
                        :fake_required="true"
                        text="Phone Number"
                    />

                    <x-form
                        field="billing_notes"
                        type="textarea"
                        text="Additional Notes for Billing"
                    />
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-center py-4">
                <div class="form-check">
                    <input class="form-check-input" onchange="toggleInfo()" name="same_info" type="checkbox" value="1" id="same_info" @if(old('same_info') == 1) checked @endif>
                    <label class="form-check-label" for="same_info">
                      Same Shipping and Billing Address
                    </label>
                </div>
            </div>
        </div>
    </div>

    <h4 class="my-3">Payment Method</h4>
    <div class="card">
        <div class="card-body">
            <div class="bg-light p-4 d-flex">
                <input type="radio" class="form-check-input me-2" checked name="payment_method" id="cash_on_delivery" value="Cash on Delivery">
                <label for="cash_on_delivery">Cash on Delivery</label>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end px-1 mt-4">
        <button type="submit" class="btn btn-primary btn-lg">
            Place Order
        </button>
    </div>

</form>

</div>
<script>
    function toggleInfo() {
        let checkbox = document.getElementById('same_info');
        if(checkbox.checked) {
            document.getElementById('billing_name').disabled = true;
            document.getElementById('billing_address').disabled = true;
            document.getElementById('billing_phone').disabled = true;
            document.getElementById('billing_notes').disabled = true;
        } else {
            document.getElementById('billing_name').disabled = false;
            document.getElementById('billing_address').disabled = false;
            document.getElementById('billing_phone').disabled = false;
            document.getElementById('billing_notes').disabled = false;
        }
    }

    // Check first time document loads (after validation)
    document.addEventListener('DOMContentLoaded', toggleInfo);
    </script>
@endsection

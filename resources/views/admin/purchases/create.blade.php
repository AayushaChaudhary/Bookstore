@extends('adminlte::page')
@section('title','Add New Purchases')
@section('plugins.Select2',true)
@section('js')
<script>
    $(document).ready(function(){
        $('#book_id').select2();
        $('#supplier_id').select2();
    })
</script>
@endsection

@section('content')

<x-alert />

<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="font-size:1.3rem;line-height:1.8;
        font-weight:bold">
        Add New Purchases</h3>
        <div class="card-tools">
            <a class="btn btn-primary" href="{{route('admin.purchases.index')}}">
            <i class="fas fa-arrow-circle-left mr-2"></i>
                Go Back
            </a>
        </div>
    </div>

    <div class="card-body">
        <form action="{{route('admin.purchases.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        <x-input
            type="select"
            field="book_id"
            text="Book"
            :options="$books"
        />

        <x-input
            type="select"
            field="supplier_id"
            text="Supplier"
            :options="$suppliers"
        />

        <x-input
            type="number"
            field="quantity"
            text="Quantity"
        />

        <x-input
            type="number"
            field="price"
            text="Unit Price"
        />

        <button class="btn btn-primary">
            <i class="fas fa-save mr-2"></i>
            Save
        </button>
        </form>
    </div>
</div>

@endsection
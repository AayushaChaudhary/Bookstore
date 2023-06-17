@extends('adminlte::page')
@section('title','Add New Stock')
@section('plugins.Select2',true)
@section('js')
<script>
    $(document).ready(function(){
        $('#book_id').select2();
        $('type').select2();
    })
</script>
@endsection

@section('content')

<x-alert />

<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="font-size:1.3rem;line-height:1.8;
        font-weight:bold">
            Add New Stocks
        </h3>
        <div class="card-tools">
            <a class="btn btn-primary" href="{{ route('admin.stocks.index') }}">
            <i class="fas fa-arrow-circle-left mr-2"></i>
                Go Back
            </a>
        </div>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.stocks.store') }}" method="post">
        @csrf


        <div class="form-group">
            <label for="book_id">Choose a Book</label>
            <select name="book_id" id="book_id" class="form-control">
                @foreach ($books as $book)
                    <option value="{{ $book->id }}">{{ $book->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="type">Choose Type</label>
            <select name="type" id="type" class="form-control">
                <option value="Incoming">Incoming</option>
                <option value="Outgoing">Outgoing</option>
            </select>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" min="0" value="{{ old('quantity') ?? 1 }}" name="quantity" id="quantity" class="form-control">
        </div>

        <button class="btn btn-primary">
            <i class="fas fa-save mr-2"></i>
            Save
        </button>
        </form>
    </div>
</div>

@endsection
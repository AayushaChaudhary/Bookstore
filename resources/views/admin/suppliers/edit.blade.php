@extends('adminlte::page')

@section('title', 'Edit Supplier')

@section('content')

<x-alert />

<div class="card">
    <div class="card-header">

        <h3 class="card-title" style="font-size: 1.5rem;line-height:1.8;font-weight:bold">
            Edit Supplier
        </h3>

        <div class="card-tools">
            <a class="btn btn-outline-secondary" href="{{ route('admin.suppliers.index') }}"> 
                <i class="fas fa-arrow-circle-left mr-2"></i>
                Go Back
            </a>
        </div>

    </div>

      <div class="card-body">
          <form action="{{ route('admin.suppliers.update', $supplier) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $supplier->name }}">
            </div>
            
            
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{ $supplier->phone }}">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control" value="{{ $supplier->address }}">
            </div>

            <div class="form-group">
                <label for="image">Supplier Image</label>
                <input type="file" name="image" class="form-control"
                value="{{$supplier->media_id}}">
            </div>


            <button class="btn btn-outline-secondary">
                <i class="fas fa-save mr-2"></i>
                Save
            </button>
          </form>
      </div>

</div>

@endsection
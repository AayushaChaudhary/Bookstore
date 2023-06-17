@extends('adminlte::page')

@section('title', 'Add New Supplier')

@section('content')

<x-alert />

<div class="card">
    <div class="card-header">

        <h3 class="card-title" style="font-size: 1.5rem;line-height:1.8;font-weight:bold">
            Add New Supplier
        </h3>

        <div class="card-tools">
            <a class="btn btn-outline-secondary" href="{{ route('admin.suppliers.index') }}"> <i class="fas fa-arrow-circle-left mr-2"></i>Go Back</a>
        </div>

    </div>

      <div class="card-body">
          <form action="{{ route('admin.suppliers.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control">
            </div>


            <div class="form-group">
                <label for="image">Photo</label>
                <input type="file" name="image" id="image" class="form-control-file @error('image') is-invalid

                @enderror">

                @error('image')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror

            </div>

            <button class="btn btn-outline-secondary">
                <i class="fas fa-save mr-2"></i>
                Save
            </button>
          </form>
      </div>

</div>

@endsection
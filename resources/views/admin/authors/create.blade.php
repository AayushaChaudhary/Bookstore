@extends('adminlte::page')
@section('title','Add New Author')

@section('content')

<x-alert />

<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="font-size:1.3rem;line-height:1.8;
        font-weight:bold">
        Add New Author</h3>
        <div class="card-tools">
            <a class="btn btn-primary" href="{{route('admin.authors.index')}}">
            <i class="fas fa-arrow-circle-left mr-2"></i>
                Go Back
            </a>
        </div>
    </div>

    <div class="card-body">
        <form action="{{route('admin.authors.store')}}" method="post">
        @csrf

        <div class="form-group">
            <label for="name">Author Name</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>

        <button class="btn btn-primary">
            <i class="fas fa-save mr-2"></i>
            Save
        </button>
        </form>
    </div>
</div>

@endsection
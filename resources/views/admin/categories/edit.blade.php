@extends('adminlte::page')
@section('title','Update Category')

@section('content')

<x-alert />

<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="font-size:1.3rem;line-height:1.8;
        font-weight:bold">
        Update Category</h3>
        <div class="card-tools">
            <a class="btn btn-primary" href="{{route('admin.categories.index')}}">
            <i class="fas fa-arrow-circle-left mr-2"></i>
                Go Back
            </a>
        </div>
    </div>

    <div class="card-body">
        <form action="{{route('admin.categories.update', $category)}}" method="post">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" name="name" id="name" class="form-control"
            value="{{$category->name}}">
        </div>

        <button class="btn btn-primary">
            <i class="fas fa-save mr-2"></i>
            Save
        </button>
        </form>
    </div>
</div>

@endsection
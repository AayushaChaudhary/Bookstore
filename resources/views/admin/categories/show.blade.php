@extends('adminlte::page')
@section('title','Category Details')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="font-size:1.3rem;line-height:1.8;
        font-weight:bold">
        Category Details</h3>
        <div class="card-tools">
            <a class="btn btn-primary" href="{{route('admin.categories.index')}}">
            <i class="fas fa-arrow-circle-left mr-2"></i>
                Go Back
            </a>
        </div>
    </div>

    <div class="card-body p-0">
        <table class="table table-bordered">
            <tr>
                <th style="width:8%">ID</th>
                <td>{{$category->id}}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{$category->name}}</td>
            </tr>
            <tr>
                <th>Created</th>
                <td>{{$category->created_at}}</td>
            </tr>
            <tr>
                <th>Updated</th>
                <td>{{$category->updated_at}}</td>
            </tr>

        </table>
    </div>
</div>

@endsection
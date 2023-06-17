@extends('adminlte::page')
@section('title','All Categories')

@section('content')

<x-alert />

<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="font-size:1.3rem;line-height:1.8;
        font-weight:bold">
        All Categories</h3>
        <div class="card-tools">
            <a class="btn btn-primary" href="{{route('admin.categories.create')}}">
            <i class="fas fa-plus-circle mr-2"></i>
                Add New
            </a>
        </div>
    </div>

    <div class="card-body p-0">
        <table class="table table-bordered">
           <thead class="bg-primary">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <td>{{$category->created_at}}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{route('admin.categories.show',$category)}}">
                    <i class="fas fa-eye mr-2"></i>
                        Show
                    </a>

                    <a class="btn btn-primary btn-sm" href="{{route('admin.categories.edit',$category)}}">
                        <i class="fas fa-edit mr-2"></i>
                            Edit
                        </a>

                    <form class="d-inline" action="{{route('admin.categories.destroy',$category)}}"
                    method="post">
                @csrf
                @method('Delete')

                <button class="btn btn-primary btn-sm">
                    <i class="fas fa-trash mr-2"></i>
                    Delete
                </button>
                </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</div>

@endsection
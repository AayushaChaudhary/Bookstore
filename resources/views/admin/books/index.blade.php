@extends('adminlte::page')
@section('title','All Books')

@section('content')

<x-alert />

<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="font-size:1.3rem;line-height:1.8;
        font-weight:bold">
        All Books</h3>
        <div class="card-tools">
            <a class="btn btn-primary" href="{{route('admin.books.create')}}">
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
            <th>Price</th>
            <th>Category</th>
            <th>Author</th>
            <th>Publisher</th>
            <th>Stock</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
            @foreach($books as $book)
            <tr>
                <td>{{ $book->id }}</td>
                <td>{{ $book->name }}</td>
                <td>
                    @if($book->on_sale)
                    <b>Rs.{{ $book->sale_price }}</b>
                    <del>Rs.{{ $book->price }}</del>
                    @else
                        Rs. {{ $book->price }}
                    @endif
                </td>
                <td>{{ $book->category->name }}</td>
                <td>{{ $book->author->name }}</td>
                <td>{{ $book->publisher->name }}</td>
                <td>{{ $book->stocks_sum_quantity }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.books.show', $book) }}">
                        <i class="fas fa-eye mr-2"></i>
                        Show
                    </a>

                    <a class="btn btn-primary btn-sm" href="{{ route('admin.books.edit', $book) }}">
                        <i class="fas fa-edit mr-2"></i>
                        Edit
                    </a>

                    <form class="d-inline" action="{{ route('admin.books.destroy', $book) }}"
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
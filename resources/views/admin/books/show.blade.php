@extends('adminlte::page')
@section('title','Books Details')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="font-size:1.3rem;line-height:1.8;
        font-weight:bold">
        Books Details</h3>
        <div class="card-tools">
            <a class="btn btn-primary" href="{{route('admin.books.index')}}">
            <i class="fas fa-arrow-circle-left mr-2"></i>
                Go Back
            </a>
        </div>
    </div>

    <div class="card-body p-0">
        <table class="table table-bordered">
            <tr>
                <th style="width:8%">ID</th>
                <td>{{ $book->id }}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $book->name }}</td>
            </tr>

            <tr>
                <th>Image</th>
                <td>
                    @if($book->media)
                    <img src="/storage/{{$book->media->path}}" height="200px"/>
                    @endif
                </td>

            </tr>


            <tr>
                <th>Edition</th>
                <td>{{ $book->name }}</td>
            </tr>
            <tr>
                <th>Type</th>
                <td>{{ $book->name }}</td>
            </tr>
            <tr>
                <th>Category</th>
                <td>{{ $book->category_id }}</td>
            </tr>
            <tr>
                <th>Author</th>
                <td>{{ $book->author_id }}</td>
            </tr>
            <tr>
                <th>Publisher</th>
                <td>{{ $book->publisher_id }}</td>
            </tr>
            <tr>
                <th>Price</th>
                <td>{{ $book->price }}</td>
            </tr>
            <tr>
                <th>on sale</th>
                <td>{{ $book->on_sale }}</td>
            </tr>
            <tr>
                <th>Sale Price</th>
                <td>{{ $book->sale_price }}</td>
            </tr>

            <tr>
                <th>Sample Pdf</th>
                <td>
                    @if($book->pdf)
                    <iframe src="/storage/{{$book->pdf->path}}"></iframe>
                    @endif
                </td>

            </tr>



            <tr>
                <th>Description</th>
                <td>{{ $book->description }}</td>
            </tr>
            <tr>
                <th>Created</th>
                <td>{{ $book->created_at }}</td>
            </tr>
            <tr>
                <th>Updated</th>
                <td>{{ $book->updated_at }}</td>
            </tr>

        </table>
    </div>
</div>

@endsection
@extends('adminlte::page')
@section('title','Update Books')
@section('plugins.Select2',true)
@section('js')
<script>
    $(document).ready(function(){
        $('#category_id').select2();
        $('#author_id').select2();
        $('#publisher_id').select2();
    })
</script>
@endsection

@section('content')

<x-alert />

<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="font-size:1.3rem;line-height:1.8;
        font-weight:bold">
        Update Books</h3>
        <div class="card-tools">
            <a class="btn btn-primary" href="{{route('admin.books.index')}}">
            <i class="fas fa-arrow-circle-left mr-2"></i>
                Go Back
            </a>
        </div>
    </div>

    <div class="card-body">
        <form action="{{route('admin.books.update', $book)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Book Name</label>
            <input type="text" name="name" id="name" class="form-control"
            value="{{$book->name}}">
        </div>

        <div class="form-group">
            <label for="image">Book Image</label>
            <input type="file" name="image" class="form-control"
            value="{{$book->media_id}}">
        </div>

        <div class="form-group">
            <label for="image">Sample PDF</label>
            <input type="file" name="sample_pdf" class="form-control">
        </div>

        <div class="form-group">
            <label for="edition">Edition</label>
            <input type="text" name="edition" id="edition" class="form-control"
            value="{{$book->edition}}">
        </div>

        <div class="form-group">
            <label for="type">Type</label>
            <input type="text" name="type" id="type" class="form-control"
            value="{{$book->type}}">
        </div>

        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                @foreach ($categories as $category )
                <option value="{{ $category->id }}" @if(old('category_id')==$category->id)selected @endif>{{ $category->name }}</option>
                @endforeach
                </select>
                    @error('category_id')
                <small class ="form-text text-danger">
                {{ $message }}</small>
                @enderror
        </div>

        <div class="form-group">
            <label for="author_id">Author</label>
            <select name="author_id" id="author_id" class="form-control @error('author_id') is-invalid @enderror">
                @foreach ($authors as $author )
                <option value="{{ $author->id }}">{{ $author->name }}</option>
                @endforeach
                </select>
                @error('author_id')
                <small class ="form-text text-danger">
                {{ $message }}</small>
                @enderror

        </div>

        <div class="form-group">
            <label for="publisher_id">Publisher</label>
            <select name="publisher_id" id="publisher_id" class="form-control @error('publisher_id') is-invalid @enderror">
                @foreach ($publishers as $publisher )
                <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                @endforeach
                </select>
                    @error('publisher_id')
                <small class ="form-text text-danger">
                {{ $message }}</small>
                @enderror
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" id="price" class="form-control"
            value="{{$book->price}}">
        </div>

        <div class="form-group">
            <label for="on_sale">

                <input type="checkbox" name="on_sale" value="1">
                <span>on Sale</span>
            </label>
        </div>

        <div class="form-group">
            <label for="sale_price">sale Price</label>
            <input type="text" name="sale_price" id="sale_price" class="form-control"
            value="{{$book->sale_price}}">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" name="description" id="description" class="form-control"
            value="{{$book->description}}">
        </div>

        <button class="btn btn-primary">
            <i class="fas fa-save mr-2"></i>
            Save
        </button>
        </form>
    </div>
</div>

@endsection
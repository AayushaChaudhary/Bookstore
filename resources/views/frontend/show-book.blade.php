@extends('frontend.layout')

@section('content')
<div class="container my-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>

            <li class="breadcrumb-item">
                <a href="/category/{{ $book->category_id }}">
                    {{ $book->category->name }}
                </a>
            </li>

            <li class="breadcrumb-item active" aria-current="page">{{ $book->name }}</li>
        </ol>
      </nav>


      <section class="py-5">
        <div class="container px-4 px-lg-5 my-2">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6">
                    <img
                        class="card-img-top mb-5 mb-md-0"
                        src="{{ $book->image }}" alt="..."
                        style="width: 100%;border-radius: 10px;height: 300px;object-fit:cover"
                    />
                </div>
                <div class="col-md-6">
                    <div class="small mb-1"></div>
                    <h1 class="display-6 fw-bolder">{{ $book->name }}</h1>
                    <div class="fs-5 mb-2">
                        @if($book->on_sale)
                        <span class="text-decoration-line-through text-muted">Rs. {{ $book->price }}</span>
                        <span class="bold">Rs. {{ $book->sale_price }}</span>
                        @else
                        <span class="bold">Rs. {{ $book->price }}</span>
                        @endif
                    </div>
                    <p class="lead mb-3">
                        Author: <a href="{{ route('author', $book->author_id) }}">
                            {{ $book->author->name }}
                        </a>
                    </p>
                    <div class="d-flex">
                        @auth
                        @if(auth()->user()->role == "User")
                        <form action="/cart/{{ $book->id }}" class="d-flex">
                            <input class="form-control text-center me-3" name="quantity" id="quantity" type="number" value="1" style="max-width: 4rem" />
                            <button class="btn btn-outline-primary flex-shrink-0" type="submit">
                                <i class="bi-cart-fill me-1"></i>
                                Add to Cart
                            </button>
                        </form>
                        @else
                        <div class="alert alert-primary">You cannot place an order!</div>
                        @endif
                        @else
                            <form action="/cart/{{ $book->id }}" class="d-flex">
                                <input class="form-control text-center me-3" name="quantity" id="quantity" type="number" value="1" style="max-width: 4rem" />
                                <button class="btn btn-outline-primary flex-shrink-0" type="submit">
                                    <i class="bi-cart-fill me-1"></i>
                                    Add to Cart
                                </button>
                            </form>
                        @endauth

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="px-4 px-lg-5 my-2">
        <table class="table">
            <tr>
                <th style="width: 150px">Type</th>
                <td>{{ $book->type }}</td>
            </tr>
            <tr>
                <th>Publisher</th>
                <td>{{ $book->publisher->name }}</td>
            </tr>
            <tr>
                <th>Category</th>
                <td>
                    <a href="{{ route('category', $book->category_id) }}">
                        {{ $book->category->name }}
                    </a>
                </td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{{ $book->description }}</td>
            </tr>
            <tr>
                <th>Sample</th>
                <td>
                    @if($book->sample_pdf_id && $book->pdf)
                    <a href="{{ route('preview', $book) }}">Preview PDF</a>
                    @else
                    There is no sample PDF!
                    @endif
                </td>
            </tr>
        </table>
    </section>
</div>

<section style="background: #f4f4f4">
    <div class="container py-4">
        <h4 class="font-bold py-3 text-center">Related Books</h4>

        <div class="row">
            @foreach($related_books as $_book)
            <div class="col-6 col-md-4 col-lg-3 mb-4">
                <x-book :book="$_book" />
            </div>
            @endforeach
        </div>

        @if(count($related_books) == 0)
            <p class="text-center mt-3">There are no related books available!</p>
        @endif
    </div>
</section>
@endsection
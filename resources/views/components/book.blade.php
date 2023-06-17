@props(['book'])
<div class="card book-card shadow-sm">
    @if($book->media_id)
    <img onclick="location.href='{{ route('book', $book) }}'" src="/storage/{{ $book->media->path }}" class="card-img-top" style="cursor:pointer" alt="...">
    @else
    <img onclick="location.href='{{ route('book', $book) }}'" src="/images/not-found.png" class="card-img-top" style="cursor:pointer" alt="">
    @endif
    <div class="card-body">
        <a href="{{ route('book', $book) }}" class="book-title card-title">
            {{ $book->name }}
        </a>
        <p class="card-text pt-1">
            by <a href="{{ route('author', $book->author) }}">{{ $book->author->name }}</a>
        </p>
        <p class="card-text">
            @if($book->on_sale)
            <b>Rs. {{ $book->sale_price }}</b>
            <del class="discount">Rs. {{ $book->price }}</del>
            @else
            <b>Rs. {{ $book->price }}</b>
            @endif
        </p>
        <div class="d-flex justify-content-between">
            <a href="{{ route('book', $book) }}" class="btn btn-primary">View More</a>
            <a href="{{ route('cart.add', $book) }}" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Add to Cart">
                <i class="bi bi-cart-plus"></i>
            </a>
        </div>
    </div>
</div>
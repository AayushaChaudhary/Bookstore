@extends('frontend.layout')

@section('content')

<section id="sliders">
    <img src="{{ asset('images/homepage/books2.jpg') }}" class="slider-image pt-2">
</section>

<section>
    <div class="container">
        <h3 class="my-5 text-center font-bold uppercase">Recent Books</h3>
        <div class="row">
            @if(count($recent_books) == 0)
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    There are no books available right now!
                </div>
            </div>
            @endif

            @foreach($recent_books as $book)
            <div class="col-6 col-md-4 col-lg-3">
                <x-book :book="$book" />
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
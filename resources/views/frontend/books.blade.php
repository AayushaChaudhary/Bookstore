@extends('frontend.layout')
@section('content')
    <div class="container pb-10">
        <h3 class="my-4 font-bold text-center">
            {{ $title ?? 'All Books' }}
        </h3>

        @if($books && count($books) > 0)
            <div class="row">
                @foreach($books as $book)
                    <div class="col-6 col-md-4 col-lg-3">
                        <x-book :book="$book" />
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center px-4 text-gray-600 text-lg">No Books Found!</p>
        @endif
    </div>
@endsection
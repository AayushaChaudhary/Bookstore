@extends('frontend.layout')
@section('content')
    <div class="wrapper pb-10">
        <h3 class="my-4 font-bold text-center">All Categories</h3>

        <div class="container">
            <div class="row">
                @foreach($categories as $category)
                    <div class="col-6 col-md-4 col-lg-3 pb-3">
                        <a
                        href="{{ route('categories', $category) }}"
                        class="card card-body"
                        style="text-decoration: none"
                        >
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="font-bold">
                                    {{ $category->name }}
                                </h5>
                                <span class="badge badge-primary">
                                    {{ $category->books_count }}
                                </span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
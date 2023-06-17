@extends('adminlte::page')

@section('content')

<div class="card">
    <div class="card-body">
        Welcome to Dashboard
        <br><br>
        <div class="row">
            <div class="col-lg-3 col-6">
            
            <div class="small-box bg-primary">
            <div class="inner">
            <h3>{{ $count['book'] }} </h3>
            <p>Books</p>
            </div>
            <div class="icon">
            <i class="ion ion-bag"></i>
            </div>
            <a href="/admin/books" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            </div>

            <div class="col-lg-3 col-6">
            
                <div class="small-box bg-primary">
                <div class="inner">
                <h3>{{ $count['category'] }}</h3>
                <p>Categories</p>
                </div>
                <div class="icon">
                <i class="ion ion-stats-bars"></i>
                </div>
                <a href="/admin/categories" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
                </div>
            
            <div class="col-lg-3 col-6">
            
            <div class="small-box bg-primary">
            <div class="inner">
            <h3>{{ $count['user'] }}</h3>
            <p>Users</p>
            </div>
            <div class="icon">
            <i class="ion ion-stats-bars"></i>
            </div>
            <a href="/admin/users" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            </div>
            
            <div class="col-lg-3 col-6">
            
            <div class="small-box bg-primary">
            <div class="inner">
            <h3>{{ $count['author'] }}</h3>
            <p>Authors</p>
            </div>
            <div class="icon">
            <i class="ion ion-person-add"></i>
            </div>
            <a href="/admin/authors" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            </div>
            
            <div class="col-lg-3 col-6">
            
            <div class="small-box bg-primary">
            <div class="inner">
            <h3>{{ $count['publisher'] }}</h3>
            <p>Publishers</p>
            </div>
            <div class="icon">
            <i class="ion ion-pie-graph"></i>
            </div>
            <a href="/admin/publishers" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            </div>
            
            </div>
    </div>
</div>

@endsection
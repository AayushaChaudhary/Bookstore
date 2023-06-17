@extends('adminlte::page')

@section('title', 'All Suppliers')

@section('content')

<x-alert />

<div class="card">
    <div class="card-header">

        <h3 class="card-title" style="font-size: 1.5rem;line-height:1.8;font-weight:bold">
            All Suppliers
        </h3>

        <div class="card-tools">
            <a class="btn btn-primary" href="{{ route('admin.suppliers.create') }}"> <i class="fas fa-user-plus mr-2"></i>Add New</a>
        </div>

    </div>

      <div class="card-body p-0">
          <table class="table table-bordered table-striped">
              <thead class="bg-primary">
                  <tr>
                      <th>ID</th>
                      <th>Photo</th>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Address</th>
                      <th>Action</th>
                  </tr>
              </thead>

              <tbody>
                  @foreach ($suppliers as $supplier)
                  <tr>
                        <td>{{ $supplier->id }}</td>
                        <td>
                        @if ($supplier->media)
                            <img src="/storage/{{ $supplier->media->path }}" height="50px" />
                        @endif
                        </td>
                        <td>{{ $supplier->name }}</td>
                        <td>{{ $supplier->phone }}</td>
                        <td>{{ $supplier->address }}</td>
                        
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.suppliers.show', $supplier) }}">
                            <i class="fas fa-eye mr-2"></i>
                            Details
                            </a>

                            <a class="btn btn-primary btn-sm" href="{{ route('admin.suppliers.edit', $supplier) }}">
                            <i class="fas fa-edit mr-2"></i>
                            Edit
                            </a>
                        </td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
      </div>

</div>

@endsection
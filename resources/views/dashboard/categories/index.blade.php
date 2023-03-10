@extends('dashboard.layouts.main')

@section('container')


{{-- @if(session()->has('loginError'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
{{ session('loginError') }}
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif --}}

<section class="section">
  <div class="row">
    <div class="col-lg-6">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Categories</h1>
      </div>

      @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
    
      <a href="/dashboard/categories/create" class="btn btn-primary mb-3">Create new category</a>
    
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"></h5>
    
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Category Name</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($categories as $category)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $category->name }}</td>
                  <td>
                    <a href="/dashboard/categories/{{ $category->slug }}" class="badge bg-info"><i class="bi bi-eye"></i></span></a>
                    <a href="/dashboard/categories/{{ $category->slug }}/edit" class="badge bg-warning"><i class="bi bi-pencil"></i></span></a>
                    <form action="/dashboard/categories/{{ $category->slug }}" method="post" class="d-inline">
                      @method('delete')
                      @csrf
                      <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><i class="bi bi-x-circle"></i></button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
    
        </div>
      </div>

    </div>

  </div>
</section>


@endsection
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
    <div class="col-lg-8">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Posts</h1>
      </div>
    
      <a href="/dashboard/posts/create" class="btn btn-primary mb-3">Create new post</a>
    
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"></h5>
    
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Category</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($posts as $post)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $post->title }}</td>
                  <td>{{ $post->category->name }}</td>
                  <td>
                    <a href="/dashboard/posts/{{ $post->slug }}" class="badge bg-info"><i class="bi bi-eye"></i></span></a>
                    <a href="/dashboard/posts/{{ $post->slug }}/edit" class="badge bg-warning"><i class="bi bi-pencil"></i></span></a>
                    <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
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
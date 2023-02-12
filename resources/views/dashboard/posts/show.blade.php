@extends('dashboard.layouts.main')

@section('container')

<div class="container">
    <div class="row justify-content-center my-4">
        <div class="col-md-8">
            <h1 class="mb-3">{{ $post->title }}</h1>

            <a href="/dashboard/posts" class="btn btn-success"><span data-feather="arrow-left" class="align-text-bottom"></span> Back to my all posts</a>
            <a href="" class="btn btn-warning"><span data-feather="edit" class="align-text-bottom"></span> Edit</a>
            <a href="" class="btn btn-danger"><span data-feather="x-circle" class="align-text-bottom"></span> Delete</a>

            <img src="https://source.unsplash.com/1200x400/?{{ $post->category->name }}" alt="{{ $post->category->name }}" class="img-fluid mt-3">

            <article class="my-3">
                {!! $post->body !!}
            </article>
            
            <a href="/posts" class="d-block mt-3">Back</a>
        </div>
    </div>
</div>

@endsection
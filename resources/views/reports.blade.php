@extends('layouts.main')

@section('container')

    <h1 class="mb-3 text-center">{{ $title }}</h1>

    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <form action="/reports">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if (request('author'))
                    <input type="hidden" name="author" value="{{ request('author') }}">
                @endif
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search.." name="search" value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">Seacrh</button>
                </div>
            </form>
        </div>
    </div>

    @if ($reports->count())

        <div class="card mb-3 text-center">
            @if ($reports[0]->image)
                <div style="max-height: 350px; overflow:hidden">
                    <img src="{{ asset('storage/' . $reports[0]->image) }}" alt="{{ $reports[0]->category->name }}" class="img-fluid">
                </div>
            @else
                <img src="https://source.unsplash.com/1200x400/?{{ $reports[0]->category->name }}" class="card-img-top" alt="{{ $reports[0]->category->name }}">
            @endif
            
            <div class="card-body">
            <h3 class="card-title"><a href="/reports/{{ $reports[0]->slug }}" class="text-decoration-none text-dark">{{ $reports[0]->title }}</a></h3>
            <p>
                <small class="text-muted">
                    By. <a href="/reports?author={{ $reports[0]->author->username }}" class="text-decoration-none">{{ $reports[0]->author->name }}</a> in <a href="/reports?category={{ $reports[0]->category->slug }}" class="text-decoration-none">{{ $reports[0]->category->name }}</a> {{ $reports[0]->created_at->diffForHumans() }}
                </small>
            </p>
            <p class="card-text">{{ $reports[0]->excerpt }}</p>
            <a href="/reports/{{ $reports[0]->slug }}" class="text-decoration-none btn btn-primary">Read more</a>
            </div>
        </div>
    

        <div class="container">
                <div class="row">
                    @foreach ($reports->skip(1) as $report)
                    
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="position-absolute px-3 py-2" style="background-color: rgba(0, 0, 0, 0.447)"><a href="/reports?category={{ $report->category->slug }}" class="text-decoration-none text-white">{{ $report->category->name }}</a></div>

                                @if ($report->image)
                                    <div style="max-height: 350px; overflow:hidden">
                                        <img src="{{ asset('storage/' . $report->image) }}" alt="{{ $report->category->name }}" class="img-fluid ">
                                    </div>
                                @else
                                    <img src="https://source.unsplash.com/500x400/?{{ $report->category->name }}" class="card-img-top" alt="{{ $report->category->name }}">
                                @endif

                                <div class="card-body">
                                <h5 class="card-title">{{ $report->title }}</h5>
                                <p>
                                    <small class="text-muted">
                                        By. <a href="/reports?author={{ $report->author->username }}" class="text-decoration-none">{{ $report->author->name }}</a> {{ $report->created_at->diffForHumans() }}
                                    </small>
                                    </p>
                                <p class="card-text">{{ $report->excerpt }}</p>
                                <a href="/reports/{{ $report->slug }}" class="btn btn-primary">Read more</a>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
        </div>

    {{-- @foreach ($posts->skip(1) as $post)
        <article class="mb-5 border-bottom pb-4">
            <h2><a href="/posts/{{ $post->slug }}" class="text-decoration-none"> {{ $post->title }}</a></h2>

            <p>By. <a href="/authors/{{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> in <a href="/categories/{{ $post->category->slug }}" class="text-decoration-none">{{ $post->category->name }}</a></p>

            <p>{{ $post->excerpt }}</p>

            <a href="/posts/{{ $post->slug }}" class="text-decoration-none">Read more..</a>
        </article>
    @endforeach --}}
    
    @else
        <p class="text-center fs-4">No post found.</p>
    @endif

    <div class="d-flex justify-content-center">
        {{ $reports->links() }}
    </div>


@endsection



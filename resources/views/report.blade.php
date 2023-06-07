@extends('layouts.main')

@section('container')
    

    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <h1 class="mb-3">{{ $report->title }}</h1>

                <p>By. <a href="/reports?author={{ $report->author->username }}" class="text-decoration-none">{{ $report->author->name }}</a> in <a href="/reports?category={{ $report->category->slug }}" class="text-decoration-none">{{ $report->category->name }}</a></p>

                @if ($report->image)
                    <div style="max-height: 350px; overflow:hidden">
                        <img src="{{ asset('storage/' . $report->image) }}" alt="{{ $report->category->name }}" class="img-fluid">
                    </div>
                @else
                    <img src="https://source.unsplash.com/1200x400/?{{ $report->category->name }}" alt="{{ $report->category->name }}" class="img-fluid">
                @endif

                <article class="my-3">
                    {!! $report->body !!}
                </article>
                
                <a href="/reports" class="d-block mt-3">Back</a>
            </div>
        </div>
    </div>

   
@endsection

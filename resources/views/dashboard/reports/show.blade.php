@extends('dashboard.layouts.main')

@section('container')

<div class="container">
    <div class="row justify-content-center my-4">
        <div class="col-md-8">
            <h1 class="mb-3">{{ $report->title }}</h1>

            <a href="/dashboard/reports" class="btn btn-success"><span data-feather="arrow-left" class="align-text-bottom"></span> Back to my all reports</a>
            <a href="/dashboard/reports/{{ $report->slug }}/edit" class="btn btn-warning"><span data-feather="edit" class="align-text-bottom"></span> Edit</a>
            <form action="/dashboard/reports/{{ $report->slug }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><span data-feather="x-circle" class="align-text-bottom"></span> Delete</button>
            </form>

            {{-- @if ($post->image)
                <div style="max-height: 350px; overflow:hidden">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}" class="img-fluid mt-3">
                </div>
            @else
                <img src="https://source.unsplash.com/1200x400/?{{ $post->category->name }}" alt="{{ $post->category->name }}" class="img-fluid mt-3">
            @endif --}}
            

            <article class="my-3">
                {!! $report->keterangan !!}
            </article>
        </div>
    </div>
</div>

@endsection
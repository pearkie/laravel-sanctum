@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Posts</h1>

    {{-- Create Post Form --}}
    <div class="mb-4">
        <h3>Create New Post</h3>
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control" id="body" name="body" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create Post</button>
        </form>
    </div>

    {{-- Display Existing Posts --}}
    @foreach($posts as $post)
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-text">{{ $post->body }}</p>
            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">View Comments</a>
            @if(auth()->id() == $post->user_id)
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            @endif
        </div>
    </div>
    @endforeach
</div>
@endsection
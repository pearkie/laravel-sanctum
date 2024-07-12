<!-- resources/views/posts/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->body }}</p>

    <hr>

    <h4>Comments</h4>
    @foreach($post->comments as $comment)
    <div class="card mt-2">
        <div class="card-body">
            <p>{{ $comment->body }}</p>
            @if(auth()->id() == $comment->user_id || auth()->id() == $post->user_id)
            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            @endif
        </div>
    </div>
    @endforeach

    <hr>

    <h4>Add a Comment</h4>
    <form action="{{ route('comments.store') }}" method="POST">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <div class="form-group">
            <textarea name="body" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Add Comment</button>
    </form>
</div>
@endsection
@extends('layouts.app')

@section('content')
<h1>{{ $post->title }}</h1>
<p>{{ $post->body }}</p>
<p>By {{ $post->user->name }}</p>

<h2>Comments</h2>
<ul>
    @foreach ($post->comments as $comment)
    <li>
        <p>{{ $comment->body }}</p>
        <p>By {{ $comment->user->name }}</p>
        @can('update', $comment)
        <form action="{{ route('comments.update', $comment->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="text" name="body" value="{{ $comment->body }}">
            <button type="submit">Update</button>
        </form>
        @endcan
        @can('delete', $comment)
        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
        @endcan
    </li>
    @endforeach
</ul>

<h3>Add a Comment</h3>
<form action="{{ route('comments.store', $post->id) }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="body">Comment:</label>
        <textarea class="form-control" id="body" name="body" rows="3" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
@extends('layouts.layout')

@section('title', 'user posts page')
@section('content')

    @if($errors->any())
        @foreach($errors->all() as $err)
            <div class="alert alert-danger">
                {{$err}}
            </div>
        @endforeach
    @endif

    <form action="{{route('posts.update', $post->id)}}" method="post">
        @csrf
        @method('PUT')
        <label class="form-label">title</label>
        <input type="text" name="title" value="{{$post->title}}" class="form-control">
        <label class="form-label">content</label>
        <textarea cols="30" rows="5" name="content" class="form-control">{{$post->content}}</textarea>
        <label class="form-label">category:</label>
        <select name="category_id" class="form-control">
            @foreach($cats as $cat)
                <option value="{{$cat->id}}" @if($cat->id == $post->category_id) selected @endif>{{$cat->name}}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary mt-3">Update post</button>
    </form>
@endsection

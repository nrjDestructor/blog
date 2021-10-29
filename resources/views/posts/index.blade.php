@extends('layouts.layout')

@section('title', 'user posts page')
@section('content')

    {{__('welcome.greeting')}}

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{session()->get('message')}}
            </div>
        @endif

        <div style="display: flex; flex-wrap: wrap; margin-top: 30px;">
        @foreach($posts as $post)

                <div class="col-sm-3">
                    <div class="card" style="min-height: 250px;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$post->title}} | {{$post->category->name}}</h5>
                            <p class="card-text">{{ \Illuminate\Support\Str::limit($post->content, $limit = 50, $end = '...')}}</p>
                            <a href="{{route('posts.show', $post->id)}}" class="btn-sm btn-secondary">Details</a>
                            @can('update', $post)
                                <a href="{{route('posts.edit', $post->id)}}" class="btn-sm btn-primary">Edit</a>
                            @endcan
                            @can('delete', $post)
                                <form style="display: inline;" action="{{route('posts.destroy', $post->id)}}" method="post" onSubmit="return beforeDelete()">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-sm btn-danger">Delete</button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>

        @endforeach
        </div>
        <a href="{{route('posts.create')}}" class="btn btn-primary mt-3 mb-3">{{__('welcome.create')}}</a>
@endsection

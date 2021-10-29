@extends('layouts.admin')

@section('title', 'admin posts page')
@section('content')

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{session()->get('message')}}
        </div>
    @endif

    <table class="table table-striped mt-5">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">TITLE</th>
            <th scope="col">CATEGORY</th>
            <th scope="col">CONTENT</th>
            <th scope="col">CREATED</th>
        </tr>
        </thead>
        <tbody>

    @foreach($posts as $post)
        <tr>
            <td class="ml-2">{{$post->id}}</td>
            <td class="ml-2">{{$post->title}}</td>
            <td class="ml-2">{{$post->category->name}}</td>
            <td class="ml-2">{{$post->content}}</td>
            <td class="ml-2">{{$post->created_at}}</td>
        </tr>
    @endforeach

        </tbody>
    </table>

@endsection

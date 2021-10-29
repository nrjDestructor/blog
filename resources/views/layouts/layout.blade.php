<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>@yield('title')</title>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{route('posts.index')}}">BLOGGING</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                @foreach($cats as $cat)
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('posts.category', $cat->id)}}">{{$cat->name}}</a>
                    </li>
                @endforeach

                <li>
                @if (Route::has('login'))
                    @auth
                            <form class="d-inline" method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button class="btn btn-success">Logout</button>
                            </form>
                        @if(auth()->user()->role_id == \App\Models\Role::ADMIN)
                                <a href="{{ route('admin.posts.index') }}" class="text-sm text-gray-700 dark:text-gray-500 underline"><button class="btn btn-primary">Admin Page</button></a>
                            @endif
                    @else
                                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline"><button class="btn btn-primary">Log in</button></a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline"><button class="btn btn-secondary">Register</button></a>
                        @endif
                    @endauth
                @endif

                </li>
            </ul>
        </div>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                {{strtoupper(app()->getLocale())}}
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                @foreach(config('app.languages') as $langLocale=>$langName)
                    <li><a class="dropdown-item" href="{{url()->current()}}?changelocale={{$langLocale}}">{{$langName}}</a></li>
                @endforeach
            </ul>
        </div>
    </nav>
    @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

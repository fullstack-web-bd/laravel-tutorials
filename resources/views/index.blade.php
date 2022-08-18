<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel Basic</title>
</head>

@php
    // dd($users_obj);
@endphp

<body class="antialiased">
    @include('nav')

    <h2>Home Page</h2>
    <p>
        {{ $name }}
    </p>
    <p>
        {{ $age }}
    </p>
    <p>
    <h4>Foreach</h4>
    <ul>
        @foreach ($users as $key => $user)
            <li> {{ $key + 1 }}) {{ $user }}</li>
        @endforeach

        @foreach ($users as $user)
            <li> {{ $loop->index + 1 }}) {{ $user }}</li>
        @endforeach

    </ul>

    <h4>For</h4>
    <ul>
        @for ($i = 0; $i < count($users); $i++)
            <li>{{ $users[$i] }}</li>
        @endfor
    </ul>
    </p>

    <h4>Users Object of Array</h4>
    <ul>
        @foreach ($users_obj as $user_obj)
            <li> {{ $user_obj->name }}</li>
            <li> {{ $user_obj->age }}</li>
            <hr>
        @endforeach
    </ul>
</body>

</html>

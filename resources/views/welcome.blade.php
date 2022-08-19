@extends('layouts.master')

@section('title')
    Welcome | {{ env('APP_NAME') }}
@endsection

@section('content')
    <div class="bg-info p-5">
        <div class="container">
            <h2>Hello Laravel</h2>
            <p>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veritatis expedita, aspernatur aliquid ratione
                voluptatum quasi similique quam dicta. Animi, veritatis aut similique voluptatem inventore dolore saepe
                magni
                neque reprehenderit consectetur.
            </p>
        </div>
    </div>
@endsection

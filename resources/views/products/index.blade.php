@extends('layouts.master')

@section('content')
    <div class="container">
        @include('partials.messages')

        <h2 class="my-3">
            Products
        </h2>

        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-3">
                    <div class="p-3 shadow">
                        <h4>
                            {{ $product->name }}
                        </h4>
                        <h5 class="text-primary mb-5">
                            {{ $product->price }} TK
                        </h5>
                        <p>
                            @if ($product->category)
                                <a href="{{ route('category.show', $product->category->id) }}">
                                    {{ $product->category->name }}
                                </a>
                            @else
                                <span class="text-warning">N/A</span>
                            @endif
                        </p>
                        <p>
                            @foreach ($product->tags as $tag)
                                <span class="bg-info px-4 py-1 rounded mx-2">
                                    <a href="{{ route('tag.show', $tag->id) }}" class="text-white ">
                                        {{ $tag->name }}
                                    </a>
                                </span>
                            @endforeach
                        </p>
                        @if ($product->user_id)
                            <p>
                                Created by - {{ Auth::user()->name }}
                            </p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

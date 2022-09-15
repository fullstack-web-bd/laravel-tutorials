@extends('layouts.master')

@section('content')
    <div class="container">
        @include('partials.messages')

        <h2 class="my-3">
            Category - {{ $category->name }}
        </h2>

        <div class="row">
            @foreach ($category->products as $product)
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
                                {{ $product->category->name }}
                            @else
                                <span class="text-warning">N/A</span>
                            @endif
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@extends('layouts.master')

@section('content')
    <div class="container">
        <h2 class="my-3">New Product</h2>

        <div class="shadow p-5">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @include('partials.messages')

                <div class="mb-3">
                    <label for="name" class="form-label">Product name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Product name"
                        value="{{ old('title') }}">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Product price</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="Product price"
                        value="{{ old('title') }}">
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select name="category_id" id="category_id" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tags" class="form-label">Tags</label>
                    <select name="tags[]" id="tags" class="form-control" multiple>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

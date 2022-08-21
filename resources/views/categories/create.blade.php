@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-body p-4">
                    <h2>New Category</h2>
                    <form action="{{ route('categories.store') }}" method="POST">
                        @include('partials.messages')

                        @csrf
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">

                        <button type="submit" class="btn btn-primary mt-2">
                            Save
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Name</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $category->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection

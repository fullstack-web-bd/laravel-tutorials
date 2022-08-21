@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-body p-4">
                    <h2>Add Documents</h2>
                    <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
                        @include('partials.messages')

                        @csrf
                        <input type="text" name="name" placeholder="Document Name" class="form-control" value="{{ old('name') }}">

                        <div class="row mt-2">
                            <div class="col-6">
                                Document documents (multiple)
                            </div>
                            <div class="col-6">
                                <input type="file" name="documents[]" id="documents" class="form-control" multiple>
                            </div>
                        </div>

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
                            <th>Document Link</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($documents as $document)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $document->name }}</td>
                                <td>
                                    <a href="{{ Storage::url($document->file) }}" target="_blank">
                                        {{ Storage::url($document->file) }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $documents->links() }}
            </div>
        </div>
    </div>
@endsection

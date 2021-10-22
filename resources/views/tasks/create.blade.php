@extends('layouts.main')
@section('main-content')
    <div class='container'>
        <div class="row my-4">
            <section class="col-12">
                <div class="card">
                    <div class="card-header">
                        Add new task
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tasks-store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" required min="3" name="title" />
                                <div class="danger">
                                    @if ($errors->any())
                                        @error('title')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

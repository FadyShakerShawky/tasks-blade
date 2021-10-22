@extends('layouts.main')
@section('main-content')
    <div class="container-fluid my-4">
        <div class="card">
            <div class="card-header">
                Tasks list
            </div>
            <div class="card-body" id="tasks-container">
                @if (count($tasks) > 0)

                    <table class="table table-hover" id="tasks-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>title</th>
                                <th>status</th>
                                <th>ready</th>
                                <th>postpone</th>
                                <th>actions</th>
                            </tr>
                        </thead>
                        <tbody>


                            @foreach ($tasks as $task)
                                <tr class="task-row @if ($task->status->title == "ready") bg-light-green @endif @if ($task->status->title == "postponed") bg-light-red @endif" data-id="{{ $task->id }}">
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $task->title }}</td>
                                    <td class="task-status" data-id="{{$task->id}}">{{ $task->status->title }}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input ready-checkbox" data-id={{ $task->id }} data-status="ready"
                                                type="checkbox" @if ($task->status->title == "ready") checked @endif/>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input postponed-checkbox" type="checkbox"
                                                data-id={{$task->id}} data-status="postponed" @if ($task->status->title == "postponed") checked @endif />
                                        </div>
                                    </td>
                                    <td>
                                        <input class="btn btn-danger delete-btn" type="button" value="Delete"
                                            data-id={{ $task->id }} />
                                        <a href="{{route("tasks-edit",["task"=>$task->id])}}" class="btn btn-warning">Update</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h4 class='text-center'>No tasks exsist yet</h4>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('page-script')
    <script src="{{ asset('scripts/tasks/list.js') }}"></script>
@endsection
@section('page-css')
    <link rel="stylesheet" href="{{ asset('scripts/tasks/list.css') }}">
@endsection

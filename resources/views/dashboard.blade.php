
@extends('layouts.app')

@section('content')
    <div class="container mt-8">
        <h1>{{ Auth::user()->name }}'s Tasks</h1>

        <form class="mb-3" method="GET" action="{{ route('tasks.index') }}">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search tasks" name="search" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>


        <div class="row mt-3 mb-3">
            <div class="col-4">
                <select class="form-control" name="status">
                    <option value="">-- Select Status --</option>
                    <option value="pending" @if(request('status') == 'pending') selected @endif>Pending</option>
                    <option value="in_progress" @if(request('status') == 'in_progress') selected @endif>In Progress</option>
                    <option value="completed" @if(request('status') == 'completed') selected @endif>Completed</option>
                </select>
            </div>
            <div class="col-4">
                <select class="form-control" name="sort_by">
                    <option value="">-- Sort By --</option>
                    <option value="created_at" @if(request('sort_by') == 'created_at') selected @endif>Created At</option>
                    <option value="status" @if(request('sort_by') == 'status') selected @endif>Status</option>
                </select>
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-primary">Filter</button>
                <button type="button" class="btn btn-secondary" onclick="window.location='{{ route("tasks.index") }}'">Clear</button>
            </div>
        </div>
        </form>

        <table class="table task-table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->status }}</td>
                    <td>{{ $task->created_at->format('Y-m-d H:i:s') }}</td>
                    <td>
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $tasks->appends(request()->except('page'))->links() }}

        <a href="{{ route('tasks.create') }}" class="btn btn-primary">Add Task</a>
    </div>
@endsection

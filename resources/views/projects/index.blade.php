@extends('layouts.app') {{-- or your main layout --}}

@section('content')
<div class="container">
    <h2>Projects</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Status</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($projects as $project)
            <tr>
                <td>{{ $project->id }}</td>
                <td>{{ $project->title }}</td>
                <td>
                    <span class="badge bg-{{ 
                        $project->status === 'completed' ? 'success' : 
                        ($project->status === 'ongoing' ? 'warning' : 'secondary') 
                    }}">
                        {{ ucfirst($project->status) }}
                    </span>
                </td>
                <td>{{ $project->description }}</td>
                <td>
                    <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-primary">Edit</a>

                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

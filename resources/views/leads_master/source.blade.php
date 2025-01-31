@extends('layouts.admin')

@section('content')
<div class="container">
    <h4 class="mb-3">Manage {{ ucfirst($type) }}</h4>

    <!-- Add Form -->
    <form action="{{ route('leads-master.store') }}" method="POST">
        @csrf
        <input type="hidden" name="type" value="{{ $type }}">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="name" class="form-control" placeholder="Enter {{ ucfirst($type) }} Name" required>
            </div>
            <div class="col-md-3">
                <input type="color" name="bg_color" class="form-control" required>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-success">Add {{ ucfirst($type) }}</button>
            </div>
        </div>
    </form>

    <!-- Data Table -->
    <table class="table mt-4">
        <thead>
            <tr>
                <th>SNo.</th>
                <th>Name</th>
                <th>Background Color</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->name }}</td>
                <td><span class="badge" style="background-color: {{ $item->bg_color }};">{{ $item->bg_color }}</span></td>
                <td>
                    <a href="{{ route('leads-master.toggleStatus', $item->id) }}" class="btn btn-sm {{ $item->status ? 'btn-success' : 'btn-danger' }}">
                        {{ $item->status ? 'Active' : 'Inactive' }}
                    </a>
                </td>
                <td>
                    <form action="{{ route('leads-master.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
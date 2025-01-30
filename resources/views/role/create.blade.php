@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3 class="mb-0 text-center">Create Role</h3>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('role.index') }}" class="btn btn-secondary btn-sm">List of Roles</a>
    </div>

    <!-- Role Creation Form -->
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('role.store') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Role Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Role Name" value="{{ old('name') }}">
                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Permissions Selection -->
                @if ($permissions->isNotEmpty())
                <div class="mb-3">
                    <label class="form-label">Assign Permissions</label>
                    <div class="row">
                        @foreach ($permissions as $permission)
                        <div class="col-md-6">
                            <div class="form-check">
                                <input type="checkbox" id="permission-{{ $permission->id }}" name="permission[]" class="form-check-input" value="{{ $permission->name }}">
                                <label class="form-check-label" for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

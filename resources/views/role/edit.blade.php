@extends('layouts.admin')

@section('content')

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Roles / Edit</h3>
        <a href="{{ route('role.index') }}" class="btn  btn-lg"><i class="fas fa-list"> </i> List of Roles</a>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('role.update', $roles->id) }}" method="post">
                @csrf

                <!-- Name Input -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Name</label>
                    <input type="text" name="name" value="{{ old('name', $roles->name) }}"
                        class="form-control" placeholder="Enter Name">
                    @error('name')
                    <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Permissions -->
                @if ($permissions->isNotEmpty())
                <div class="mb-3">
                    <label class="form-label fw-bold">Assign Permissions</label>
                    <div class="row">
                        @foreach ($permissions as $permission)
                        <div class="col-md-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="permission-{{ $permission->id }}"
                                    name="permission[]" value="{{ $permission->name }}"
                                    {{ $haspermissions->contains($permission->name) ? 'checked' : '' }}>
                                <label class="form-check-label" for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Submit Button -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-outline-warning">Update</button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection

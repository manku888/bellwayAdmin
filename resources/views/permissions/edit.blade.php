@extends('layouts.admin')

@section('content')

<div class="container ">
    <h3 class="mb-3">Edit Permission</h3>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('permissions.update', $permission->id) }}" method="post">
                @csrf

                <!-- Name Input -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Name</label>
                    <input type="text" name="name" value="{{ old('name', $permission->name) }}"
                        class="form-control text-secondary" placeholder="Enter Name">
                    @error('name')
                    <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-outline-warning">Update</button>
            </form>
        </div>
    </div>
</div>

@endsection

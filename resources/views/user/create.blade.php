@extends('layouts.admin')

@section('content')

<div class="container mt-4">
    <h3 class="mb-3 text-center">Create User</h3>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('user.index') }}" class="btn btn-secondary btn-sm">List of Users</a>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('user.store') }}" method="post">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{ old('name') }}">
                    @error('name')
                    <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter Email" value="{{ old('email') }}">
                    @error('email')
                    <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter Password">
                    @error('password')
                    <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
                    @error('confirm_password')
                    <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role Selection -->
                @if ($roles->isNotEmpty())
                <div class="mb-3">
                    <label class="form-label fw-bold">Assign Roles</label>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($roles as $role)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="role-{{ $role->id }}" name="role[]" value="{{ $role->name }}">
                            <label class="form-check-label" for="role-{{ $role->id }}">{{ $role->name }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Submit Button -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Create User</button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection

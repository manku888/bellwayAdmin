@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center py-2">
        <h3 class="">Create User</h3>
        <a href="{{ route('user.index') }}" class="btn  btn-lg">
            <i class="fas fa-list"> </i> List of Users
        </a>
    </div>

    <div class="card border-light shadow">
        <div class="card-header  text-white" style="background-color: gray;">
            <h5 class="card-title">User Information</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('user.store') }}" method="post">
                @csrf

                <!-- Name -->
                <div class="form-group mb-4">
                    <label class="h6">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{ old('name') }}">
                    @error('name')
                    <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- color -->
                 <!-- Background Color -->
                    <div class="form-group mb-4">
                        <label class="h6">Background Color</label>
                        <input type="color" name="bg_color" class="form-control" value="{{ old('bg_color', '#ffffff') }}">
                        @error('bg_color')
                        <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                <!-- Email -->
                <div class="form-group mb-4">
                    <label class="h6">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter Email" value="{{ old('email') }}">
                    @error('email')
                    <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group mb-4 position-relative">
                    <label class="h6">Password</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password">
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password', 'eye-icon1')">
                            <i id="eye-icon1" class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                    <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group mb-4 position-relative">
                    <label class="h6">Confirm Password</label>
                    <div class="input-group">
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password">
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('confirm_password', 'eye-icon2')">
                            <i id="eye-icon2" class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('confirm_password')
                    <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Role Selection -->
                @if ($roles->isNotEmpty())
                <div class="form-group mb-4">
                    <label class="h6">Assign Roles</label>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($roles as $role)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="role-{{ $role->id }}" name="role[]" value="{{ $role->name }}">
                            <label class="" for="role-{{ $role->id }}">{{ $role->name }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Submit Button -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-outline-success">Create User</button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- Password Toggle Script -->
<script>
    function togglePassword(inputId, eyeIconId) {
        let passwordInput = document.getElementById(inputId);
        let eyeIcon = document.getElementById(eyeIconId);

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        }
    }
</script>
@endsection

@extends('layouts.admin')

@section('content')

<div class="container mt-4">
    <h3 class="mb-3 text-center">Create Permission</h3>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('permissions.index') }}" class="btn btn-secondary btn-sm">Permissions List</a>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('permissions.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{ old('name') }}">
                    @error('name')
                    <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@extends('layouts.admin')

@section('content')

<div class="container ">

    <div class="d-flex justify-content-between align-items-center py-2">
        <h3 class="">Create Permission</h3>
        <a href="{{ route('permissions.index') }}" class="btn  btn-lg"> <i class="fas fa-list"> </i> Permissions List</a>
    </div>

    <div class="card border-light shadow">
        <div class="card-body">
            <form action="{{ route('permissions.store') }}" method="post">
                @csrf
                <div class="form-group mb-4">
                    <label class="h6">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter permission name" value="{{ old('name') }}">
                    @error('name')
                    <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-outline-success">Create permisssion</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

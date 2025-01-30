@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center py-2">
    <h3 class="">Edit User</h3>
    <a href="{{ route('user.index') }}" class="btn  btn-lg">
        <i class="fas fa-list"> </i>  List of Users
    </a>
</div>

<div class="">
    <div class="">
        <div class="card border-light shadow-lg">
            <div class="card-header bg-secondary text-white">
                <h5 class="card-title">User Information</h5>
            </div>
            <div class="card-body">

                <form action="{{route('user.update', $users->id)}}" method="post">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="name" class="h5 text-primary">Name</label>
                        <input value="{{ old('name',$users->name) }}" name="name" type="text" placeholder="Enter Name"
                            class="form-control form-control-lg @error('name') is-invalid @enderror">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="email" class="h5 text-primary">Email</label>
                        <input value="{{ old('email',$users->email) }}" name="email" type="email" placeholder="Enter Email"
                            class="form-control form-control-lg @error('email') is-invalid @enderror">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label class="h5 text-primary">Roles</label>
                        <div class="row">
                            @if ($roles->isNotEmpty())
                            @foreach ($roles as $role)
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="checkbox" name="role[]" value="{{$role->name}}" id="role-{{$role->id}}"
                                        class="form-check-input @if($hasRoles->contains($role->id)) checked @endif">
                                    <label class="form-check-label" for="role-{{$role->id}}">{{$role->name}}</label>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success btn">
                            <i class="fas fa-save"></i> Update User
                        </button>
                        <a href="{{ route('user.index') }}" class="btn btn-danger btn">
                            <i class="fas fa-times-circle"></i> Cancel
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection

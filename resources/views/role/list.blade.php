@extends('layouts.admin')

@section('content')

<div class="container ">

    <div class="d-flex justify-content-between align-items-center py-2">
        <h3 class="">Roles</h3>
        <a href="{{ route('role.create') }}" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-plus"></i> &nbsp Create Role</a>
    </div>

    <div class="table-responsive ">
        <table class="table table-striped table-bordered ">
            <thead class="bg-light">
                <tr class="text-center">
                    <th>S/N</th>
                    <th>Name</th>
                    <th>Permissions</th>
                    <th>Created</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                <tr class="{{ $loop->odd ? 'bg-white' : 'custom-bg-offwhite' }}">
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->permissions->pluck('name')->implode(', ') }}</td>
                    <td class="text-center">{{ $role->created_at->format('d M, Y') }}</td>
                    <td class="text-center">
                        <div class="btn-group d-flex gap-2">
                            <!-- Edit Button -->
                            <a href="{{ route('role.edit', $role->id) }}" class="btn text-warning btn-md">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <!-- Delete Form -->
                            <form action="{{ route('role.destroy', $role->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn text-danger btn-md"
                                    onclick="return confirm('Are you sure you want to delete this role?')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-3">
        {{ $roles->links() }}
    </div>
</div>

<!-- Custom Styling -->
<style>
    .custom-bg-offwhite {
        background-color: whitesmoke !important;
    }

    .bg-light {
        background-color: #f0f0f0 !important;
    }
</style>

@endsection

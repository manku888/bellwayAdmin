@extends('layouts.admin')

@section('content')

<div class="container ">

    <div class="d-flex justify-content-between align-items-center py-2">
        <h3 class="">Roles</h3>
        @can('Create Role')
        <a href="{{ route('role.create') }}" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-plus"></i> &nbsp Create Role</a>
        @endcan
    </div>

    <div class="table-responsive ">
    <table class="table table-bordered"
            style="background-color: whitesmoke;  overflow: hidden;">
            <thead class="text-center rounded-top " style="background-color:
#1c99f3; border-top-left-radius: 10px; border-top-right-radius: 10px; color: white;">
                <tr class="text-center">
                    <th  class="py-3">S/N</th>
                    <th  class="py-3">Name</th>
                    <th  class="py-3">Permissions</th>
                    <th  class="py-3">Created</th>
                    <th  class="py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                <tr style="background-color: {{ $loop->index % 2 == 0 ? '#f9f9f9;' : 'white' }};">
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
                             @can('Delete Role')
                            <form action="{{ route('role.destroy', $role->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn text-danger btn-md"
                                    onclick="return confirm('Are you sure you want to delete this role?')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                            @endcan
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



@endsection

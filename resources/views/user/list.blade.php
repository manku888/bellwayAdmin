@extends('layouts.admin')

@section('content')

<div class="container ">

    <!-- Create Button -->
    @can('Create User')
    <div class="d-flex justify-content-between align-items-center py-2">
        <h3 class="text-center mb-4">Users</h3>
        <a href="{{ route('user.create') }}" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-plus"></i> &nbsp Create new User</a>
    </div>
    @endcan

    <!-- Responsive Table -->
    <div class="table-responsive">
    <table class="table table-bordered"
            style="background-color: whitesmoke;  overflow: hidden;">
            <thead class="text-center rounded-top " style="background-color:
#1c99f3; border-top-left-radius: 10px; border-top-right-radius: 10px; color: white;">
                <tr class="text-center">
                    <th class="py-3">S/N</th>
                    <th class="py-3">Name</th>
                    <th>Background Color</th>
                    <th class="py-3">Email</th>
                    <th class="py-3">Role</th>
                    <th class="py-3">Created</th>
                    <th class="py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                <tr style="background-color: {{ $loop->index % 2 == 0 ? '#f9f9f9;' : 'white' }};">
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>
                         <span class="badge rounded-pill" style="background-color: {{ $user->bg_color }};">{{ $user->bg_color }}</span>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->roles()->pluck('name')->implode(', ') }}</td>
                    <td class="text-center">{{ $user->created_at->format('d M, Y') }}</td>
                    <td class="text-center">
                        <div class="btn-group ">
                            <!-- Edit Button -->
                             @can('Edit User')
                            <a href="{{ route('user.edit', $user->id) }}" class="btn text-warning btn-md">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            @endcan
                            <!-- Delete Form -->
                             @can('Delete User')
                            <form action="{{ route('user.destroy', $user->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn text-danger btn-md"
                                    onclick="return confirm('Are you sure you want to delete this user?')">
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
        {{ $users->links() }}
    </div>
</div>



@endsection

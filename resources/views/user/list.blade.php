@extends('layouts.admin')

@section('content')

<div class="container ">

    <!-- Create Button -->
    @can('create user')
    <div class="d-flex justify-content-between align-items-center py-2">
        <h3 class="text-center mb-4">Users</h3>
        <a href="{{ route('user.create') }}" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-plus"></i> &nbsp Create new User</a>
    </div>
    @endcan

    <!-- Responsive Table -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered text-nowrap">
            <thead class="bg-light">
                <tr class="text-center">
                    <th>S/N</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                <tr class="{{ $loop->odd ? 'bg-white' : 'custom-bg-offwhite' }}">
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->roles()->pluck('name')->implode(', ') }}</td>
                    <td class="text-center">{{ $user->created_at->format('d M, Y') }}</td>
                    <td class="text-center">
                        <div class="btn-group ">
                            <!-- Edit Button -->
                            <a href="{{ route('user.edit', $user->id) }}" class="btn text-warning btn-md">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <!-- Delete Form -->
                            <form action="{{ route('user.destroy', $user->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn text-danger btn-md"
                                    onclick="return confirm('Are you sure you want to delete this user?')">
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
        {{ $users->links() }}
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

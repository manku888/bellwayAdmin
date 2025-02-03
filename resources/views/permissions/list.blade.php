@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center py-2">
        <h3 class="text-center mb-4">Permissions</h3>
        @can('Create Permission')
        <a href="{{ route('permissions.create') }}" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-plus"></i> &nbsp Create new Permission</a>
        @endcan
    </div>

    <div class="table-responsive ">
    <table class="table table-bordered"
            style="background-color: whitesmoke;  overflow: hidden;">
            <thead class="text-center rounded-top " style="background-color:
#1c99f3; border-top-left-radius: 10px; border-top-right-radius: 10px; color: white;">
                <tr class="text-center">
                    <th class="py-3">S/N</th>
                    <th class="py-3">Name</th>
                    <th class="py-3">Created</th>
                    <th class="py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                // Calculate the starting serial number
                $serial = ($permissions->currentPage() - 1) * $permissions->perPage() + 1;
                @endphp

                @foreach ($permissions as $permission)
                <tr style="background-color: {{ $loop->index % 2 == 0 ? '#f9f9f9;' : 'white' }};">
                    <td class="text-center">{{ $serial++ }}</td>
                    <td>{{ $permission->name }}</td>
                    <td class="text-center">{{ $permission->created_at->format('d M, Y') }}</td>
                    <td class="text-center">
                        <div class="btn-group  ">
                            <!-- Edit Button -->
                             @can('Edit Permission')
                            <a href="{{ route('permissions.edit', $permission->id) }}" class="btn  btn-md text-warning">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            @endcan
                            <!-- Delete Form -->
                             @can('Delete Permission')
                            <form action="{{ route('permissions.destroy', $permission->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn  btn-md text-danger"
                                    onclick="return confirm('Are you sure you want to delete this permission?')">
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
        {{ $permissions->links() }}
    </div>
</div>



@endsection

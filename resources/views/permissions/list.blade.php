@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center py-2">
        <h3 class="text-center mb-4">Permissions</h3>
        <a href="{{ route('permissions.create') }}" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-plus"></i> &nbsp Create new Permission</a>
    </div>

    <div class="table-responsive ">
        <table class="table table-striped table-bordered text-nowrap">
            <thead class="bg-light">
                <tr class="text-center">
                    <th>S/N</th>
                    <th>Name</th>
                    <th>Created</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                // Calculate the starting serial number
                $serial = ($permissions->currentPage() - 1) * $permissions->perPage() + 1;
                @endphp

                @foreach ($permissions as $permission)
                <tr class="{{ $loop->odd ? 'bg-white' : 'custom-bg-offwhite' }}">
                    <td class="text-center">{{ $serial++ }}</td>
                    <td>{{ $permission->name }}</td>
                    <td class="text-center">{{ $permission->created_at->format('d M, Y') }}</td>
                    <td class="text-center">
                        <div class="btn-group  ">
                            <!-- Edit Button -->
                            <a href="{{ route('permissions.edit', $permission->id) }}" class="btn  btn-md text-warning">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <!-- Delete Form -->
                            <form action="{{ route('permissions.destroy', $permission->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn  btn-md text-danger"
                                    onclick="return confirm('Are you sure you want to delete this permission?')">
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
        {{ $permissions->links() }}
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

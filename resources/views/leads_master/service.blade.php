@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h4 class="mb-4">Manage {{ ucfirst($type) }}</h4>

    <!-- Add Form Section -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <form action="{{ route('leads-master.store') }}" method="POST">
                @csrf
                <input type="hidden" name="type" value="{{ $type }}">

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="name" class="form-label fw-bold">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter {{ ucfirst($type) }} Name" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="bg_color" class="form-label fw-bold">Background Color</label>
                        <div class="d-flex align-items-center">
                            <!-- Color Picker Input -->
                            <input type="color" name="bg_color" id="bg_color" class="form-control form-control-color" value="#ff0000" required style="width: 50px; height: 50px; border: none; cursor: pointer;">
                            <!-- Color Label for better UI -->
                            <span class="ms-3" id="colorLabel" style="font-size: 16px; color: #000;">#ff0000</span>
                        </div>
                        <script>
                            document.getElementById('bg_color').addEventListener('input', function() {
                                var color = this.value;
                                document.getElementById('colorLabel').textContent = color;
                                document.getElementById('colorLabel').style.color = color;
                            });
                        </script>
                    </div>

                    <div class="col-md-3 mb-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-outline-success w-100">Add {{ ucfirst($type) }}</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <!-- Data Table Section -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>SNo.</th>
                            <th>Name</th>
                            <th>Background Color</th>
                            <th>Status</th>
                            <th>Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td><span class="badge rounded-pill" style="background-color: {{ $item->bg_color }};">{{ $item->bg_color }}</span></td>
                            <td>
                                <!-- Active/Inactive Toggle -->
                                <form action="{{ route('leads-master.toggleStatus', $item->id) }}" method="GET">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault{{ $item->id }}" name="status" {{ $item->status ? 'checked' : '' }} onchange="this.form.submit()">
                                        <label class="form-check-label" for="flexSwitchCheckDefault{{ $item->id }}">{{ $item->status ? 'Active' : 'Inactive' }}</label>
                                    </div>
                                </form>
                            </td>
                            <td>

                                <!-- Delete Icon Button -->
                                @can('delete Lead master list')
                                <form action="{{ route('leads-master.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn text-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
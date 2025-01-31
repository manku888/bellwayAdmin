@extends('layouts.admin')

@section('content')
<div class="container mt-4 shadow py-4">
    <h3 class="mb-4">Create Lead</h3>

    <form method="POST" action="{{ route('lead.store') }}">
        @csrf

        <!-- Row 1: Assignee, Service, Status -->
        <div class="row mb-4">
            <div class="col-md-4">
                <label for="assignee" class="form-label">Assignee</label>
                <select class="form-control" name="assignee" required>
                    <option value="">Select Assignee</option>
                    @foreach ($assignees as $assignee)
                    <option value="{{ $assignee }}">{{ $assignee }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="service" class="form-label">Service</label>
                <select class="form-control" name="service" required>
                    <option value="">Select Service</option>
                    @foreach ($services as $service)
                    <option value="{{ $service }}">{{ $service }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" name="status" required>
                    <option value="">Select Status</option>
                    @foreach ($statuses as $status)
                    <option value="{{ $status }}">{{ $status }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Row 2: Source, Budget, Full Name -->
        <div class="row mb-4">
            <div class="col-md-4">
                <label for="source" class="form-label">Source</label>
                <select class="form-control" name="source" required>
                    <option value="">Select Source</option>
                    @foreach ($sources as $source)
                    <option value="{{ $source }}">{{ $source }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="budget" class="form-label">Budget</label>
                <input type="text" class="form-control" name="budget" placeholder="Enter estimated budget">
            </div>

            <div class="col-md-4">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" class="form-control" name="full_name" required>
            </div>
        </div>

        <!-- Row 3: Phone Number, City, Email -->
        <div class="row mb-4">
            <div class="col-md-4">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" class="form-control" name="phone_number" required>
            </div>

            <div class="col-md-4">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" name="city">
            </div>

            <div class="col-md-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email">
            </div>
        </div>

        <!-- Row 4: Submit & View Lead Buttons -->
        <div class="d-flex justify-content-center gap-4">
            <button type="submit" class="btn btn-outline-success">
                <i class="fa-solid fa-plus"></i > Add Lead
            </button>
            <a href="{{ route('lead.index') }}" class="btn btn-outline-secondary" >
                <i class="fa-solid fa-eye"></i> View Leads
            </a>
        </div>
    </form>

</div>

@endsection

<!-- JavaScript to Handle "Other" Option Visibility -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function toggleOtherInput(selectElement, inputElement) {
            if (selectElement.value === 'other') {
                inputElement.style.display = 'block';
            } else {
                inputElement.style.display = 'none';
            }
        }

        // Assignee
        const assigneeSelect = document.querySelector('select[name="assignee"]');
        const assigneeOtherInput = document.querySelector('input[name="assignee_other"]');
        assigneeSelect.addEventListener('change', function() {
            toggleOtherInput(assigneeSelect, assigneeOtherInput);
        });

        // Similar toggle functions for Service, Status, Source...
    });
</script>

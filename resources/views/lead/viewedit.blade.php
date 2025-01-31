@extends('layouts.admin')

@section('content')
    <h3>Edit Lead</h3>
    <div class="d-flex justify-content-end ">

        <a href="{{ route('lead.index') }}" class="btn btn-secondary btn-sm mb-3">Back</a>
    </div>
    <form id="leadForm" action="{{ route('lead.update', $lead->id) }}" style="background-color: rgb(232, 231, 231); padding: 15px; border-radius: 5px;">
        @csrf
        <!-- Use PUT for update -->

        <!-- Pencil Icon -->
         @can('view-edit lead')
        <div class="text-end">
            <button type="button" id="editButton" class="btn btn-outline-secondary">
            <i class="fa-solid fa-pen   "></i>
            </button>
        </div>
        @endcan

        <!-- Row 1 -->
        <div class="row mb-3 mt-2">
            <div class="col-md-4">
                <label for="assignee" class="form-label">Assignee</label>
                <select class="form-control" name="assignee" required disabled>
                    <option value="">Select Assignee</option>
                    @foreach ($assignees as $assignee)
                        <option value="{{ $assignee }}" {{ $lead->assignee == $assignee ? 'selected' : '' }}>
                            {{ $assignee }}
                        </option>
                    @endforeach

                </select>

            </div>

            <div class="col-md-4">
                <label for="service" class="form-label">Service</label>
                <select class="form-control" name="service" required disabled>
                    <option value="">Select Service</option>
                    @foreach ($services as $service)
                        <option value="{{ $service }}" {{ $lead->service == $service ? 'selected' : '' }}>
                            {{ $service }}
                        </option>
                    @endforeach

                </select>

            </div>

            <div class="col-md-4">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" name="status" required disabled>
                    <option value="">Select Status</option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status }}" {{ $lead->status == $status ? 'selected' : '' }}>
                            {{ $status }}
                        </option>
                    @endforeach

                </select>

            </div>
        </div>

        <!-- Row 2 -->
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="source" class="form-label">Source</label>
                <select class="form-control" name="source" required disabled>
                    <option value="">Select Source</option>
                    @foreach ($sources as $source)
                        <option value="{{ $source }}" {{ $lead->source == $source ? 'selected' : '' }}>
                            {{ $source }}
                        </option>
                    @endforeach

                </select>

            </div>

            <div class="col-md-4">
                <label for="budget" class="form-label">Budget</label>
                <input type="text" class="form-control" name="budget" value="{{ $lead->budget }}" disabled>
            </div>

            <div class="col-md-4">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" class="form-control" name="full_name" value="{{ $lead->full_name }}" required disabled>
            </div>
        </div>

        <!-- Row 3 -->
        <div class="row mb-3">
                <div class="col-md-4">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" name="phone_number" value="{{ $lead->phone_number }}" required readonly>
                </div>

            <div class="col-md-4">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" name="city" value="{{ $lead->city }}" disabled>
            </div>

            <div class="col-md-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $lead->email }}" required readonly>
            </div>
        </div>

        <!-- Row 4 -->
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" disabled>{{ $lead->description }}</textarea>
            </div>

            <div class="col-md-4">
                <label for="follow_up_date" class="form-label">Follow Up Date</label>
                <input type="datetime-local" class="form-control" name="follow_up_date" value="{{ $lead->follow_up_date ? date('Y-m-d\TH:i', strtotime($lead->follow_up_date)) : '' }}" disabled>
            </div>
        </div>

      <!-- Submit Button (Initially hidden) -->
      <!-- <div class="text-center d-flex justify-content-center gap-3" id="submitSection">
            <button type="submit" class="btn btn-primary" class="submitbtn">Update Lead</button>
            <a href="{{ route('lead.index') }}" class="btn btn-secondary">Back</a>
        </div> -->


       <!-- Submit Button (Initially hidden) -->
<div class="text-center d-flex justify-content-center gap-3 d-none" id="submitSection">
    <button type="submit" class="btn btn-primary">Update Lead</button>
</div>
    </form>

<!-- CSS for hiding and showing elements -->



<!-- JavaScript -->
<script>
document.getElementById('editButton').addEventListener('click', function() {
    let formFields = document.querySelectorAll('#leadForm input, #leadForm select, #leadForm textarea');
    let submitSection = document.getElementById('submitSection');
    let isDisabled = formFields[0].disabled; // Check if fields are currently disabled

    // Toggle the disabled/readonly state of all form fields except phone number and email
    formFields.forEach(function(field) {
        if (field.name !== 'phone_number' && field.name !== 'email') {
            field.disabled = !isDisabled; // Enable/disable fields
        } else {
            // For phone number and email, set readonly instead of disabled
            if (!isDisabled) {
                field.readOnly = true; // Prevent editing for email and phone number
            }
        }
    });

    // Show/hide submit section based on the editable state
    if (isDisabled) {
        submitSection.classList.remove('d-none'); // Show the submit button
    } else {
        submitSection.classList.add('d-none'); // Hide the submit button
    }
});

</script>

@endsection


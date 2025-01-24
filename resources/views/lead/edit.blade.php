@extends('layouts.admin')

@section('content')
    <h3>Edit Lead</h3>

    <form  action="{{ route('lead.update', $lead->id) }}">
        @csrf
         <!-- Use PUT for update -->

        <!-- Row 1 -->
        <div class="row mb-3 mt-2">
            <div class="col-md-4">
                <label for="assignee" class="form-label">Assignee</label>
                <select class="form-control" name="assignee" required>
                    <option value="">Select Assignee</option>
                    @foreach ($assignees as $assignee)
                        <option value="{{ $assignee }}" {{ $lead->assignee == $assignee ? 'selected' : '' }}>
                            {{ $assignee }}
                        </option>
                    @endforeach
                    <option value="other" {{ !in_array($lead->assignee, $assignees) ? 'selected' : '' }}>Other</option>
                </select>
                <input type="text" class="form-control mt-2" name="assignee_other"
                    placeholder="Enter Assignee Name"
                    style="{{ !in_array($lead->assignee, $assignees) ? '' : 'display: none;' }}"
                    value="{{ !in_array($lead->assignee, $assignees) ? $lead->assignee : '' }}">
            </div>

            <div class="col-md-4">
                <label for="service" class="form-label">Service</label>
                <select class="form-control" name="service" required>
                    <option value="">Select Service</option>
                    @foreach ($services as $service)
                        <option value="{{ $service }}" {{ $lead->service == $service ? 'selected' : '' }}>
                            {{ $service }}
                        </option>
                    @endforeach
                    <option value="other" {{ !in_array($lead->service, $services) ? 'selected' : '' }}>Other</option>
                </select>
                <input type="text" class="form-control mt-2" name="service_other"
                    placeholder="Enter Service"
                    style="{{ !in_array($lead->service, $services) ? '' : 'display: none;' }}"
                    value="{{ !in_array($lead->service, $services) ? $lead->service : '' }}">
            </div>

            <div class="col-md-4">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" name="status" required>
                    <option value="">Select Status</option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status }}" {{ $lead->status == $status ? 'selected' : '' }}>
                            {{ $status }}
                        </option>
                    @endforeach
                    <option value="other" {{ !in_array($lead->status, $statuses) ? 'selected' : '' }}>Other</option>
                </select>
                <input type="text" class="form-control mt-2" name="status_other"
                    placeholder="Enter Status"
                    style="{{ !in_array($lead->status, $statuses) ? '' : 'display: none;' }}"
                    value="{{ !in_array($lead->status, $statuses) ? $lead->status : '' }}">
            </div>
        </div>

        <!-- Row 2 -->
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="source" class="form-label">Source</label>
                <select class="form-control" name="source" required>
                    <option value="">Select Source</option>
                    @foreach ($sources as $source)
                        <option value="{{ $source }}" {{ $lead->source == $source ? 'selected' : '' }}>
                            {{ $source }}
                        </option>
                    @endforeach
                    <option value="other" {{ !in_array($lead->source, $sources) ? 'selected' : '' }}>Other</option>
                </select>
                <input type="text" class="form-control mt-2" name="source_other"
                    placeholder="Enter Source"
                    style="{{ !in_array($lead->source, $sources) ? '' : 'display: none;' }}"
                    value="{{ !in_array($lead->source, $sources) ? $lead->source : '' }}">
            </div>

            <div class="col-md-4">
                <label for="budget" class="form-label">Budget</label>
                <input type="text" class="form-control" name="budget" value="{{ $lead->budget }}">
            </div>

            <div class="col-md-4">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" class="form-control" name="full_name" value="{{ $lead->full_name }}" required>
            </div>
        </div>

        <!-- Row 3 -->
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" class="form-control" name="phone_number" value="{{ $lead->phone_number }}" required>
            </div>

            <div class="col-md-4">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" name="city" value="{{ $lead->city }}">
            </div>

            <div class="col-md-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="{{ $lead->email }}">
            </div>
        </div>

        <!-- Row 4 -->

        <div class="row mb-3">
            <div class="col-md-4">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description"></textarea>
                </div>

                 <div class="col-md-4">
                <label for="last_follow_up_date" class="form-label">Last Follow Up Date</label>
                <input type="datetime-local" class="form-control" name="last_follow_up_date">
            </div>
            <!-- <div class="col-md-4">
                <label for="follow_up_date" class="form-label">Follow Up Date & Time</label>
                <input type="datetime-local" class="form-control" name="follow_up_date"
                    value="{{ $lead->follow_up_date ? date('Y-m-d\TH:i', strtotime($lead->follow_up_date)) : '' }}" required>
            </div> -->
        </div>

        <!-- Submit Button -->
        <div class="text-center d-flex justify-content-center gap-3">
            <button type="submit" class="btn btn-primary">Update Lead</button>
            <a href="{{ route('lead.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </form>

    <!-- JavaScript for showing text input when "Other" is selected in dropdown -->
    <script>
        document.querySelectorAll('select').forEach(function(select) {
            select.addEventListener('change', function() {
                let inputField = this.nextElementSibling;
                if (this.value === 'other') {
                    inputField.style.display = 'block';
                } else {
                    inputField.style.display = 'none';
                }
            });
        });
    </script>

@endsection

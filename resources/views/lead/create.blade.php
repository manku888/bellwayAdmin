@extends('layouts.admin')

@section('content')
    <h3>Create Lead</h3>

    <form method="POST" action="{{ route('lead.store') }}">
        @csrf

        <!-- Row 1 -->
        <div class="row mb-3 mt-2">
            <div class="col-md-4">
                <label for="assignee" class="form-label">Assignee</label>
                <select class="form-control" name="assignee" required>
                    <option value="">Select Assignee</option>
                    @foreach ($assignees as $assignee)
                        <option value="{{ $assignee }}">{{ $assignee }}</option>
                    @endforeach
                    <!-- <option value="other">Other</option> -->
                </select>
                <!-- <input type="text" class="form-control mt-2" name="assignee_other" placeholder="Enter Assignee Name" style="display: none;"> -->
            </div>

            <div class="col-md-4">
                <label for="service" class="form-label">Service</label>
                <select class="form-control" name="service" required>
                    <option value="">Select Service</option>
                    @foreach ($services as $service)
                        <option value="{{ $service }}">{{ $service }}</option>
                    @endforeach
                    <!-- <option value="other">Other</option> -->
                </select>
                <!-- <input type="text" class="form-control mt-2" name="service_other" placeholder="Enter Service" style="display: none;"> -->
            </div>

            <div class="col-md-4">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" name="status" required>
                    <option value="">Select Status</option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status }}">{{ $status }}</option>
                    @endforeach
                    <!-- <option value="other">Other</option> -->
                </select>
                <!-- <input type="text" class="form-control mt-2" name="status_other" placeholder="Enter Status" style="display: none;"> -->
            </div>
        </div>

        <!-- Row 2 -->
        <div class="row mb-3">
        <div class="col-md-4">
        <label for="source" class="form-label">Source</label>
        <select class="form-control" name="source" required>
            <option value="">Select Source</option>
            @foreach ($sources as $source)
                <option value="{{ $source }}">{{ $source }}</option>
            @endforeach
            <!-- <option value="other">Other</option> -->
        </select>
        <!-- <input type="text" class="form-control mt-2" name="source_other" placeholder="Enter Source" style="display: none;"> -->
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

        <!-- Row 3 -->
        <div class="row mb-3">
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

        <!-- Row 4 -->
        <div class="row mb-3">
            <!-- <div class="col-md-4">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description"></textarea>
            </div> -->

            <!-- <div class="col-md-4">
                <label for="last_follow_up_date" class="form-label">Last Follow Up Date</label>
                <input type="datetime-local" class="form-control" name="last_follow_up_date">
            </div> -->

            <!-- <div class="col-md-4">
                <label for="follow_up_date" class="form-label">Follow Up Date & Time</label>
                <input type="datetime-local" class="form-control" name="follow_up_date" required>
            </div> -->
        </div>




            <!-- Submit Button and View Lead Button -->
            <div class="text-center d-flex justify-content-center gap-3">
                <!-- Add Lead Button (Submit) -->
                <button type="submit" class="btn btn-primary">Add Lead</button>

                <!-- View Lead Button (Separate Link) -->
                <a href="{{ route('lead.index') }}" class="btn btn-secondary">View Leads</a>
            </div>




    </form>

    <!-- <form action="{{route('lead.index')}}" method="Get">
            <button class="btn btn-secondary"> View lead</button>
        </form> -->
</div>

<!-- JavaScript for showing text input when "Other" is selected in dropdown -->
<!-- <script>
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
</script> -->


<!-- JavaScript to Handle "Other" Option -->
<script>
     document.addEventListener('DOMContentLoaded', function() {
        // Function to toggle visibility of "Other" input fields
        function toggleOtherInput(selectElement, inputElement) {
            if (selectElement.value === 'other') {
                inputElement.style.display = 'block'; // Show the input field
            } else {
                inputElement.style.display = 'none'; // Hide the input field
            }
        }

        // Assignee
        const assigneeSelect = document.querySelector('select[name="assignee"]');
        const assigneeOtherInput = document.querySelector('input[name="assignee_other"]');
        assigneeSelect.addEventListener('change', function() {
            toggleOtherInput(assigneeSelect, assigneeOtherInput);
        });

        // Service
        const serviceSelect = document.querySelector('select[name="service"]');
        const serviceOtherInput = document.querySelector('input[name="service_other"]');
        serviceSelect.addEventListener('change', function() {
            toggleOtherInput(serviceSelect, serviceOtherInput);
        });

        // Status
        const statusSelect = document.querySelector('select[name="status"]');
        const statusOtherInput = document.querySelector('input[name="status_other"]');
        statusSelect.addEventListener('change', function() {
            toggleOtherInput(statusSelect, statusOtherInput);
        });

        // Source
        const sourceSelect = document.querySelector('select[name="source"]');
        const sourceOtherInput = document.querySelector('input[name="source_other"]');
        sourceSelect.addEventListener('change', function() {
            toggleOtherInput(sourceSelect, sourceOtherInput);
        });
    });
</script>

@endsection

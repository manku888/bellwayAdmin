@extends('layouts.admin')

@section('content')
<div class="container">
    <h3>Call-Requests</h3>

    @if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

    <table class="custom-table">
        <thead>
            <tr>
                <th>S/N.</th>
                <th>Full Name</th>
                <th>City</th>
                <th>Phone</th>
                <th>Date</th>
                <th>Time</th>
                <th>Message</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($calldatas as $calldata)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $calldata->name }}</td>
                    <td>{{ $calldata->city }}</td>
                    <td>{{ $calldata->phone_no }}</td>
                    <td>{{ $calldata->date }}</td>
                    <td>{{ $calldata->time }}</td>
                    <td style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 200px;">{{ $calldata->message }}</td>
                    <td style="text-align: center;">
                        <button
                            class="btn btn-primary btn-sm view-call-btn"
                            data-name="{{ $calldata->name }}"
                            data-city="{{ $calldata->city }}"
                            data-phone_no="{{ $calldata->phone_no }}"
                            data-date="{{ $calldata->date }}"
                            data-time="{{ $calldata->time }}"
                            data-message="{{ $calldata->message }}">
                            <i class="fa-solid fa-eye"></i>
                        </button>

                        <!-- delete -->
                        <form action="{{ url('admin/call/delete', $calldata->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn  btn-sm" onclick="return confirm('Are you sure you want to delete this hiring data?')">
                            <i class="fa-solid fa-trash " style="color: red;"></i>
                        </button>
                    </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal for Viewing Call Request Details -->
<div class="modal fade" id="viewCallModal" tabindex="-1" aria-labelledby="viewCallModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewCallModalLabel">Call Request Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Full Name:</strong> <span id="modal-call-name"></span></p>
                <p><strong>City:</strong> <span id="modal-call-city"></span></p>
                <p><strong>Phone:</strong> <span id="modal-call-phone"></span></p>
                <p><strong>Date:</strong> <span id="modal-call-date"></span></p>
                <p><strong>Time:</strong> <span id="modal-call-time"></span></p>
                <p><strong>Message:</strong></p>
                <!-- Container for Message with Scroll and Wrap -->
                <div id="modal-call-message" style="border: 1px solid #ddd; padding: 10px; border-radius: 5px; background: #f9f9f9; max-height: 300px; overflow-y: auto; white-space: pre-wrap; word-break: break-word;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get all "view" buttons
        const viewButtons = document.querySelectorAll('.view-call-btn');

        viewButtons.forEach(button => {
            button.addEventListener('click', function () {
                // Get data attributes from the clicked button
                const name = this.getAttribute('data-name');
                const city = this.getAttribute('data-city');
                const phoneNo = this.getAttribute('data-phone_no');
                const date = this.getAttribute('data-date');
                const time = this.getAttribute('data-time');
                const message = this.getAttribute('data-message');

                // Populate the modal with data
                document.getElementById('modal-call-name').textContent = name;
                document.getElementById('modal-call-city').textContent = city;
                document.getElementById('modal-call-phone').textContent = phoneNo;
                document.getElementById('modal-call-date').textContent = date;
                document.getElementById('modal-call-time').textContent = time;
                document.getElementById('modal-call-message').textContent = message;

                // Show the modal
                const viewCallModal = new bootstrap.Modal(document.getElementById('viewCallModal'));
                viewCallModal.show();
            });
        });
    });

     // script for success msg close Automatically after 5 seconds
     setTimeout(function() {
        let successAlert = document.getElementById('success-alert');
        if (successAlert) {
            successAlert.style.display = 'none';
        }
    }, 5000); // 5000ms = 5 seconds
</script>

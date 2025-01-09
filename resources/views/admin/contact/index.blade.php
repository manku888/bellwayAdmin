@extends('layouts.admin')

@section('content')
<div class="container">
    <h3>Contacts</h3>

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
                <th>Email</th>
                <th>Phone</th>
                <th>Date</th>
                <th>Time</th>
                <th>Service of Interest</th>
                <th>Message</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $contact->full_name }}</td>
                    <td>{{ $contact->city }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->phone_no }}</td>
                    <td>{{$contact->date}}</td>
                    <td>{{$contact->time}}</td>
                    <td>{{ implode(', ', $contact->service_of_interest) }}</td>
                    <td style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 200px;">{{ $contact->message }}</td>
                    <td style="text-align: center;">
                        <button
                            class="btn btn-primary btn-sm view-btn"
                            data-full_name="{{ $contact->full_name }}"
                            data-city="{{ $contact->city }}"
                            data-email="{{ $contact->email }}"
                            data-phone_no="{{ $contact->phone_no }}"
                            data-service_of_interest="{{ implode(', ', $contact->service_of_interest) }}"
                            data-message="{{ $contact->message }}">
                            <i class="fa-solid fa-eye"></i>
                        </button>

                          <!-- Delete Button -->
                    <form action="{{ url('admin/contacts/delete', $contact->id) }}" method="POST" style="display: inline-block;">
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

<!-- Bootstrap Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Contact Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Full Name:</strong> <span id="modal-full-name"></span></p>
                <p><strong>City:</strong> <span id="modal-city"></span></p>
                <p><strong>Email:</strong> <span id="modal-email"></span></p>
                <p><strong>Phone:</strong> <span id="modal-phone"></span></p>
                <p><strong>Service of Interest:</strong> <span id="modal-service"></span></p>
                <p><strong>Message:</strong></p>
                <!-- Container for Message with Scroll and Wrap -->
                <div id="modal-message" style="border: 1px solid #ddd; padding: 10px; border-radius: 5px; background: #f9f9f9; max-height: 300px; overflow-y: auto; white-space: pre-wrap; word-break: break-word;"></div>
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
        const viewButtons = document.querySelectorAll('.view-btn');

        viewButtons.forEach(button => {
            button.addEventListener('click', function () {
                // Get data attributes from the clicked button
                const fullName = this.getAttribute('data-full_name');
                const city = this.getAttribute('data-city');
                const email = this.getAttribute('data-email');
                const phoneNo = this.getAttribute('data-phone_no');
                const serviceOfInterest = this.getAttribute('data-service_of_interest');
                const message = this.getAttribute('data-message');

                // Populate the modal with data
                document.getElementById('modal-full-name').textContent = fullName;
                document.getElementById('modal-city').textContent = city;
                document.getElementById('modal-email').textContent = email;
                document.getElementById('modal-phone').textContent = phoneNo;
                document.getElementById('modal-service').textContent = serviceOfInterest;
                document.getElementById('modal-message').textContent = message;

                // Show the modal
                const viewModal = new bootstrap.Modal(document.getElementById('viewModal'));
                viewModal.show();
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

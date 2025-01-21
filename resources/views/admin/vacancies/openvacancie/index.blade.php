@extends('layouts.admin')

@section('content')
<div class="container">
    <h3>Open-Vacancy</h3>

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
                <th>Email</th>
                <th>Phone</th>
                <th>Date</th>
                <th>time</th>
                <th>Resume</th>
                <th>Service</th>
                <th>Message</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($openvacancies as $openvacancy)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $openvacancy->name }}</td>
                    <td>{{ $openvacancy->email }}</td>
                    <td>{{ $openvacancy->phone_no }}</td>
                    <td>{{ $openvacancy->date }}</td>
                    <td>{{ $openvacancy->time }}</td>
                    <td><a href="{{ $openvacancy->resume_link }}" target="_blank">View Resume</a></td>
                    <td>{{ $openvacancy->service }}</td>
                    <td style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 300px;">{{ $openvacancy->message }}</td>
                    <td style="text-align:center; display:flex; align-items:center;">
                        <button
                            class="btn btn-primary btn-sm view-contact-btn"
                            data-name="{{ $openvacancy->name }}"
                            data-email="{{ $openvacancy->email }}"
                            data-phone_no="{{ $openvacancy->phone_no }}"
                            data-resume_link="{{ $openvacancy->resume_link }}"
                            data-service="{{ $openvacancy->service }}"
                            data-message="{{ $openvacancy->message }}">
                            <i class="fa-solid fa-eye"></i>
                        </button>

                        <!-- delete -->
                         @can('delete openvacancie')
                        <form action="{{ url('admin/openvacancie/delete', $openvacancy->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn  btn-sm" onclick="return confirm('Are you sure you want to delete this hiring data?')">
                            <i class="fa-solid fa-trash " style="color: red; margin-top:15px;"></i>
                        </button>
                    </form>
                    @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
        <div class="d-flex justify-content-end mt-3 ">
            {{$openvacancies->links()}}
        </div>
    </table>
</div>

<!-- Modal for Viewing Contact Details -->
<div class="modal fade" id="viewContactModal" tabindex="-1" aria-labelledby="viewContactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewContactModalLabel">Contact Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
    <p><strong>Full Name:</strong> <span id="modal-contact-name"></span></p>
    <p><strong>Email:</strong> <span id="modal-contact-email"></span></p>
    <p><strong>Phone:</strong> <span id="modal-contact-phone"></span></p>
    <p><strong>Resume:</strong> <a id="modal-contact-resume" href="#" target="_blank">View Resume</a></p>
    <p><strong>Service:</strong> <span id="modal-contact-service"></span></p>
    <p><strong>Message:</strong></p>
    <div id="modal-contact-message" style="border: 1px solid #ddd; padding: 10px; border-radius: 5px; background: #f9f9f9;"></div>
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
        // Get all "Eye" buttons
        const viewButtons = document.querySelectorAll('.view-contact-btn');

        viewButtons.forEach(button => {
            button.addEventListener('click', function () {
                // Get data attributes from the clicked button
                const name = this.getAttribute('data-name');
                const email = this.getAttribute('data-email');
                const phoneNo = this.getAttribute('data-phone_no');
                const resumeLink = this.getAttribute('data-resume_link');
                const service = this.getAttribute('data-service');
                const message = this.getAttribute('data-message');

                // Populate the modal with the data
                document.getElementById('modal-contact-name').textContent = name;
                document.getElementById('modal-contact-email').textContent = email;
                document.getElementById('modal-contact-phone').textContent = phoneNo;
                document.getElementById('modal-contact-resume').href = resumeLink;
                document.getElementById('modal-contact-service').textContent = service;
                document.getElementById('modal-contact-message').textContent = message;

                // Show the modal
                const viewContactModal = new bootstrap.Modal(document.getElementById('viewContactModal'));
                viewContactModal.show();
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

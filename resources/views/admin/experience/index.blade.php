@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Experience</h3>
    <!-- s-m -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <!-- table -->
    <div class="table-responsive">
    <table class="table table-bordered"
            style="background-color: whitesmoke;  overflow: hidden;">
            <thead class="text-center rounded-top " style="background-color:
#1c99f3; border-top-left-radius: 10px; border-top-right-radius: 10px; color: white;">
                <tr>
                    <th  class="py-3">S/N.</th>
                    <th  class="py-3">Full Name</th>
                    <th  class="py-3">Email</th>
                    <th  class="py-3">Phone</th>
                    <th  class="py-3">Date</th>
                    <th  class="py-3">time</th>
                    <th  class="py-3">Current Location</th>
                    <th  class="py-3">Current CTC</th>
                    <th  class="py-3">Notice Period</th>
                    <th  class="py-3">Total Experience (in years)</th>
                    <th  class="py-3">Resume Link</th>
                    <th  class="py-3">Selected Role</th>
                    <th  class="py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="text-nowrap">
                @foreach($experiences as $experience)
                <tr style="background-color: {{ $loop->index % 2 == 0 ? '#f9f9f9;' : 'white' }};">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $experience->name }}</td>
                    <td>{{ $experience->email }}</td>
                    <td>{{ $experience->phone_no }}</td>
                    <td>{{ $experience->date }}</td>
                    <td>{{ $experience->time }}</td>
                    <td>{{ $experience->current_location }}</td>
                    <td>{{ $experience->current_ctc }}</td>
                    <td>{{ $experience->notice_period }}</td>
                    <td>{{ $experience->total_experience }}</td>
                    <td><a href="{{ $experience->resume_link }}" target="_blank" class="text-decoration-none text-primary d-flex align-items-center" target="_blank">
                            <i class="fa-solid fa-file-pdf me-2"></i>View Resume
                        </a></td>
                    <td>{{ $experience->selected_role }}</td>
                    <td style="text-align:center; display:flex; align-items:center;">
                        <button
                            class="btn  btn-sm view-experience-btn"
                            data-name="{{ $experience->name }}"
                            data-email="{{ $experience->email }}"
                            data-phone_no="{{ $experience->phone_no }}"
                            data-current_location="{{ $experience->current_location }}"
                            data-current_ctc="{{ $experience->current_ctc }}"
                            data-notice_period="{{ $experience->notice_period }}"
                            data-total_experience="{{ $experience->total_experience }}"
                            data-resume_link="{{ $experience->resume_link }}"
                            data-selected_role="{{ $experience->selected_role }}">
                            <i class="fa-solid fa-eye"></i>
                        </button>

                        <!-- delete -->
                        @can('Delete Experiences Vacancy')
                        <form action="{{ url('admin/experience/delete', $experience->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn  btn-sm" onclick="return confirm('Are you sure you want to delete this hiring data?')">
                                <i class="fa-solid fa-trash " style="color: red; margin-top: 15px;"></i>
                            </button>
                        </form>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <div class="d-flex justify-content-end mt-3 ">
        {{$experiences->links()}}
    </div>
</div>

<!-- Modal for Viewing Experience Details -->
<div class="modal fade" id="viewExperienceModal" tabindex="-1" aria-labelledby="viewExperienceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewExperienceModalLabel">Experience Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Full Name:</strong> <span id="modal-exp-name"></span></p>
                <p><strong>Email:</strong> <span id="modal-exp-email"></span></p>
                <p><strong>Phone:</strong> <span id="modal-exp-phone"></span></p>
                <p><strong>Current Location:</strong> <span id="modal-exp-location"></span></p>
                <p><strong>Current CTC:</strong> <span id="modal-exp-ctc"></span></p>
                <p><strong>Notice Period:</strong> <span id="modal-exp-notice"></span></p>
                <p><strong>Total Experience:</strong> <span id="modal-exp-experience"></span></p>
                <p><strong>Resume Link:</strong> <a id="modal-exp-resume" class="text-decoration-none" href="#" target="_blank"><i class="fa-solid fa-file-pdf me-2"></i> View Resume</a></p>
                <p><strong>Selected Role:</strong> <span id="modal-exp-role"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all "view" buttons
        const viewButtons = document.querySelectorAll('.view-experience-btn');

        viewButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Get data attributes from the clicked button
                const name = this.getAttribute('data-name');
                const email = this.getAttribute('data-email');
                const phoneNo = this.getAttribute('data-phone_no');
                const currentLocation = this.getAttribute('data-current_location');
                const currentCTC = this.getAttribute('data-current_ctc');
                const noticePeriod = this.getAttribute('data-notice_period');
                const totalExperience = this.getAttribute('data-total_experience');
                const resumeLink = this.getAttribute('data-resume_link');
                const selectedRole = this.getAttribute('data-selected_role');

                // Populate the modal with data
                document.getElementById('modal-exp-name').textContent = name;
                document.getElementById('modal-exp-email').textContent = email;
                document.getElementById('modal-exp-phone').textContent = phoneNo;
                document.getElementById('modal-exp-location').textContent = currentLocation;
                document.getElementById('modal-exp-ctc').textContent = currentCTC;
                document.getElementById('modal-exp-notice').textContent = noticePeriod;
                document.getElementById('modal-exp-experience').textContent = totalExperience;
                document.getElementById('modal-exp-resume').href = resumeLink;
                document.getElementById('modal-exp-role').textContent = selectedRole;

                // Show the modal
                const viewExperienceModal = new bootstrap.Modal(document.getElementById('viewExperienceModal'));
                viewExperienceModal.show();
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

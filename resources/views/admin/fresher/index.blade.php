@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Freshers</h3>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
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
                    <th  class="py-3">Resume</th>
                    <th  class="py-3">Cover Letter</th>
                    <th  class="py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fresherdatas as $fresherdata)
                <tr style="background-color: {{ $loop->index % 2 == 0 ? '#f9f9f9;' : 'white' }};">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $fresherdata->name }}</td>
                    <td>{{ $fresherdata->email }}</td>
                    <td>{{ $fresherdata->phone_no }}</td>
                    <td>{{ $fresherdata->date }}</td>
                    <td>{{ $fresherdata->time }}</td>
                    <td><a href="{{ $fresherdata->resume }}" target="_blank" class="text-decoration-none text-primary d-flex align-items-center" target="_blank">
                            <i class="fa-solid fa-file-pdf me-2"></i>View Resume</a></td>
                    <td style="overflow: hidden; text-overflow: ellipsis;  max-width: 200px; ">{{ $fresherdata->cover_letter }}</td>
                    <td style="text-align: center;">
                        <button
                            class="btn  btn-sm view-fresher-btn"
                            data-name="{{ $fresherdata->name }}"
                            data-email="{{ $fresherdata->email }}"
                            data-phone_no="{{ $fresherdata->phone_no }}"
                            data-resume="{{ $fresherdata->resume }}"
                            data-cover_letter="{{ $fresherdata->cover_letter }}">
                            <i class="fa-solid fa-eye"></i>
                        </button>

                        <!-- delete -->
                        @can('Delete Freshers Vacancy')
                        <form action="{{ url('admin/fresher/delete', $fresherdata->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn  btn-sm" onclick="return confirm('Are you sure you want to delete this hiring data?')">
                                <i class="fa-solid fa-trash " style="color: red;"></i>
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
        {{$fresherdatas->links()}}
    </div>
</div>

<!-- Modal for Viewing Fresher Details -->
<div class="modal fade" id="viewFresherModal" tabindex="-1" aria-labelledby="viewFresherModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewFresherModalLabel">Fresher Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Full Name:</strong> <span id="modal-fresher-name"></span></p>
                <p><strong>Email:</strong> <span id="modal-fresher-email"></span></p>
                <p><strong>Phone:</strong> <span id="modal-fresher-phone"></span></p>
                <p><strong>Resume:</strong> <a id="modal-fresher-resume" class="text-decoration-none" href="#" target="_blank"> <i class="fa-solid fa-file-pdf me-2"></i> View Resume</a></p>
                <p><strong>Cover Letter:</strong></p>
                <!-- Container for Cover Letter with Scroll and Wrap -->
                <div id="modal-fresher-cover" style="border: 1px solid #ddd; padding: 10px; border-radius: 5px; background: #f9f9f9; max-height: 300px; overflow-y: auto; white-space: pre-wrap; word-break: break-word;"></div>
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
        const viewButtons = document.querySelectorAll('.view-fresher-btn');

        viewButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Get data attributes from the clicked button
                const name = this.getAttribute('data-name');
                const email = this.getAttribute('data-email');
                const phoneNo = this.getAttribute('data-phone_no');
                const resume = this.getAttribute('data-resume');
                const coverLetter = this.getAttribute('data-cover_letter');

                // Populate the modal with data
                document.getElementById('modal-fresher-name').textContent = name;
                document.getElementById('modal-fresher-email').textContent = email;
                document.getElementById('modal-fresher-phone').textContent = phoneNo;
                document.getElementById('modal-fresher-resume').href = resume;
                document.getElementById('modal-fresher-cover').textContent = coverLetter;

                // Show the modal
                const viewFresherModal = new bootstrap.Modal(document.getElementById('viewFresherModal'));
                viewFresherModal.show();
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

@extends('layouts.admin')

@section('content')
<section class="container shadow">
    <div class="container mt-4 ">
        <h3 class="mb-4">Create Hiring</h3>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <form action="{{url('admin/hiring/store')}}" method="POST" class="">
            @csrf

            <!-- Position -->
            <div class="">
                <label for="position" class="form-label">Position</label>
                <input list="positions" name="position" id="position" class="form-control w-50" placeholder="Enter or select positions">
                <datalist id="positions">
                    <option value="Manager">
                    <option value="HR">
                    <option value="Team-leader">
                    <option value="Laravel Developer">
                    <option value="Flutter Developer">
                    <option value="Node JS Developer">
                    <option value="UI/UX Developer">
                    <option value="Tester">
                </datalist>
            </div>

            <!-- Experience -->
            <div class="mb-3">
                <label for="experience" class="form-label">Experience</label>
                <input type="text" name="experience" id="experience" class="form-control w-50" placeholder="Enter experience like 0 to 1">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-outline-success">Submit</button>
        </form>
    </div>

    <!-- Hiring Image -->
    <div class="w-75 mx-auto">
        <img src="https://img.freepik.com/free-vector/flat-employment-agency-search-new-employees-hire_88138-802.jpg?t=st=1738325193~exp=1738328793~hmac=97e99bf8df5da8573a420b47df294d310cc64d72953d254709de749518660f89&w=1060" alt="hiring image is not found" class="img-fluid">
    </div>
</section>

@endsection

<!-- JavaScript for automatically closing the success message -->
<script>
    setTimeout(function() {
        let successAlert = document.getElementById('success-alert');
        if (successAlert) {
            successAlert.style.display = 'none';
        }
    }, 5000); // 5000ms = 5 seconds
</script>

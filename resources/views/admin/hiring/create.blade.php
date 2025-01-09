@extends('layouts.admin')

@section('content')
<section class="parent">
<div class="container2">
    <h3 style="">Create Hiring</h3>

    @if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

    <form action="{{url('admin/hiring/store')}}" method="POST">
        @csrf

        <div class="mb-3">
    <label for="position" class="form-label">Position</label>
    <input list="positions" name="position" id="position" class="form-control" placeholder="Enter or select positions" style="width: 100%;">
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
            <label for="experience" class="form-label">Experience</label><br>
            <input type="text" name="experience" id="experience" placeholder="Enter experience like 0 to 1 " style="width: 100%;">
            <!-- <select name="experience" id="experience" class="form-control">
                <option value="" disabled selected>Select experience</option>
                @for($i = 1; $i <= 10; $i++)
                    <option value="{{ $i }}">{{ $i }} years</option>
                @endfor
            </select> -->
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<div class="hiring">
    <img src="/admin/images/admin_logo/hiring.jpg" alt="hiring image is not found">
</div>
</section>
@endsection

<!-- script for success msg close Automatically after 5 seconds -->
<script>

    setTimeout(function() {
        let successAlert = document.getElementById('success-alert');
        if (successAlert) {
            successAlert.style.display = 'none';
        }
    }, 5000); // 5000ms = 5 seconds
</script>

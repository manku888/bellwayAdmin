<!-- @extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Add Contact</h1>
    <form action="{{ route('contact.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="full_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>City</label>
            <input type="text" name="city" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Phone No</label>
            <input type="text" name="phone_no" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Service of Interest</label>
            <select name="service_of_interest[]" class="form-control" multiple required>
                <option value="Web Design & Development">Web Design & Development</option>
                <option value="UI/UX Design">UI/UX Design</option>
                <option value="Mobile App Development">Mobile App Development</option>
            </select>
        </div>

        <div class="form-group">
            <label>Message</label>
            <textarea name="message" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>
@endsection -->

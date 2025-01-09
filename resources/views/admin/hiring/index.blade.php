@extends('layouts.admin')

@section('content')

<div class="container">
    <h3>Hiring Data</h3>
    <table class="custom-table">
        <thead>
            <tr>
                <th>S/N.</th>
            <th>Position</th>
            <th>Experience</th>
            <th>Date</th>
            <th>time</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hirings as $hiring )
            <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{$hiring->positions}}</td>
            <td>{{$hiring->experience}}</td>
            <td>{{$hiring->date}}</td>
            <td>{{$hiring->time}}</td>
            <td>
                    <!-- Update Button
                    <a href="{{ url('admin/hiring/edit', $hiring->id) }}" class="btn btn-warning btn-sm">
                        <i class="fa-solid fa-pen 1xl"></i> Update
                    </a> -->

                    <!-- Delete Button -->
                    <form action="{{ url('admin/hiring/delete', $hiring->id) }}" method="POST" style="display: inline-block;">
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

@endsection

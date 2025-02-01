@extends('layouts.admin')

@section('content')

<div class="container mt-4">
    <h3 class="mb-4">Hiring Data</h3>
    <div class="table-responsive">
        <table class="custom-table table table-striped table-bordered text-nowrap" style="background-color: whitesmoke;">
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
                <tr style="background-color: white;">
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
                        @can('delete hiring')
                        <form action="{{ url('admin/hiring/delete', $hiring->id) }}" method="POST" style="display: inline-block;">
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
        {{$hirings->links()}}
    </div>
</div>

@endsection

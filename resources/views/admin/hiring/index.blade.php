@extends('layouts.admin')

@section('content')

<div class="container mt-4">
    <h3 class="mb-4">Hiring Data</h3>
    <div class="table-responsive">
    <table class="table table-bordered"
            style="background-color: whitesmoke;  overflow: hidden;">
            <thead class="text-center rounded-top " style="background-color:
#1c99f3; border-top-left-radius: 10px; border-top-right-radius: 10px; color: white;">
                <tr>
                    <th class="py-3">S/N.</th>
                    <th class="py-3">Position</th>
                    <th class="py-3">Experience</th>
                    <th class="py-3">Date</th>
                    <th class="py-3">time</th>
                    <th class="py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="text-nowrap">
                @foreach ($hirings as $hiring )
                <tr style="background-color: {{ $loop->index % 2 == 0 ? '#f9f9f9;' : 'white' }};">
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
                        @can('Delete Hiring')
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

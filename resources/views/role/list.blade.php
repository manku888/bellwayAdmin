@extends('layouts.admin')

@section('content')

<h3>Roles</h3>



<div class="flex justify-between">

    <div class="d-flex justify-content-end mb-3">
        <a href="{{route('role.create')}}"  class="btn btn-secondary btn-sm">Create</a>
    </div>



    <table class="custom-table" style="margin-bottom:2px;">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Name</th>
                <th>Permissions</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
           @foreach ($roles as $role )
             <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{$role->name}}</td>
                <td>{{$role->permissions->pluck('name')->implode(' ,  ')}}</td>
                <td>{{( $role->created_at)->format('d M, Y') }}</td>


                <td>

                <!-- edit -->
                    <a href="{{route('role.edit',$role->id)}}" class="text-primary " >
                    <button class="btn  btn-sm">
                    <i class="fa-solid fa-pen"></i>
                    </button>

                    <!-- delete -->
                 <form action="{{route('role.destroy',$role->id)}}" method="post" >
                 @csrf
                 @method('delete')

                 <button type="submit" class="btn  btn-sm" onclick="return confirm('Are you sure you want to delete this hiring data?')">
                            <i class="fa-solid fa-trash " style="color: red;"></i>
                        </button>
                </form>

                </td>
             </tr>


           @endforeach

        </tbody>

    </table>

    <div>
        {{$roles->links()}}
    </div>
</div>


















@endsection


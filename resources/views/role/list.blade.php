@extends('layouts.admin')

@section('content')

<h3>Roles</h3>



<div class="flex justify-between">

    <a href="{{route('role.create')}}"  class="bg-slate-700 text-sm rounded-md text-black px-2 py-1">Create</a>



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

                    <a href="{{route('role.edit',$role->id)}}" class="text-primary " >
                    <button>edit</button></a>

                 <form action="{{route('role.destroy',$role->id)}}" method="post" >
                 @csrf
                 @method('delete')

                 <button class="text-danger ">delete</button>
                </form>

                </td>
             </tr>


           @endforeach

        </tbody>

    </table>

</div>


















@endsection


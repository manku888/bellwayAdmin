@extends('layouts.admin')

@section('content')
<h3>Permissions</h3>



<div class="flex justify-between">

    <a href="{{route('permissions.create')}}"  class="bg-slate-700 text-sm rounded-md text-black px-2 py-1">Create</a>


    <table class="custom-table" style="margin-bottom:2px;">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Name</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
           @foreach ($permissions as $permission )
             <tr>
             <td>{{ $loop->iteration }}</td>
             <td>{{$permission->name}}</td>
             <td>{{( $permission->created_at)->format('d M, Y') }}</td>

             <td>

                 <a href="{{route('permissions.edit',$permission->id)}}" class="text-primary " >
                    <button>edit</button></a>
                 <!-- <a href="{{route('permissions.destroy',$permission->id)}}" Method="delete" class="text-danger " >delete</a> -->

                 <form action="{{route('permissions.destroy',$permission->id)}}" method="post" >
                 @csrf
                 @method('delete')

                 <button class="text-danger ">delete</button>
                </form>

             </td>


             </tr>


           @endforeach

        </tbody>
        <!-- {{$permissions->links()}} -->
    </table>
</div>


















@endsection


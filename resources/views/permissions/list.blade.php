@extends('layouts.admin')

@section('content')
<h3>Permissions</h3>



<div class="flex justify-between">

<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('permissions.create') }}" class="btn btn-secondary btn-sm ">
     Create
    </a>
</div>



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
        @php
            // Calculate the starting serial number
            $serial = ($permissions->currentPage() - 1) * $permissions->perPage() + 1;
        @endphp

           @foreach ($permissions as $permission )
             <tr>
                <td>{{$serial++}}</td>
             <!-- <td>{{ $loop->iteration }}</td> -->
             <td>{{$permission->name}}</td>
             <td>{{( $permission->created_at)->format('d M, Y') }}</td>

             <td>

                 <a href="{{route('permissions.edit',$permission->id)}}"  >
                    <button class="btn  btn-sm">
                    <i class="fa-solid fa-pen"></i>
                    <!-- <i class="ri-pencil-line"></i> -->
                    </button>

                </a>
                 <!-- <a href="{{route('permissions.destroy',$permission->id)}}" Method="delete" class="text-danger " >delete</a> -->

                 <form action="{{route('permissions.destroy',$permission->id)}}" method="post" >
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
         <div class="d-flex justify-content-end ">
            {{$permissions->links()}}
         </div>
</div>


















@endsection


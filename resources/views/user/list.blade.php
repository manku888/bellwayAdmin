@extends('layouts.admin')

@section('content')

<h3>Users</h3>



<div class="flex justify-between">

    <!-- <a href="#"  class="bg-slate-700 text-sm rounded-md text-black px-2 py-1">Create</a> -->



    <table class="custom-table" style="margin-bottom:2px;">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
           @foreach ($users as $user )
             <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->roles()->pluck('name')->implode(', ')}}</td>
                <td>{{( $user->created_at)->format('d M, Y') }}</td>

                <td>

                    <a href="{{route('user.edit',$user->id)}}" class="text-primary " >
                    <button class="btn  btn-sm">
                    <i class="fa-solid fa-pen"></i>
                    </button>

                 <form action="{{route('user.destroy',$user->id)}}" method="post" >
                 @csrf
                 @method('delete')

                 <button type="submit" class="btn  btn-sm" onclick="return confirm('Are you sure you want to delete this hiring data?')">
                            <i class="fa-solid fa-trash " style="color: red;"></i>
                        </button>
                </form>
                </form>

                </td>

             </tr>


           @endforeach

        </tbody>

    </table>

    <div>
        {{$users->links()}}
    </div>

</div>


















@endsection


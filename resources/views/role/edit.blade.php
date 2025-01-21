@extends('layouts.admin')

@section('content')

<h3>Roles / edit</h3>
<div class="d-flex justify-content-end me-3">

    <a href="{{ route('role.index') }}" class="btn btn-secondary btn-sm">list of roles</a>
</div>

<!-- create permistions -->
<div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                 <form action="{{route('role.update', $roles->id)}}" method="post">
                  @csrf
                    <div>
                        <label for="" class="text-lg font-medium ms-1">Name</label>
                      <div class="my-3">
                           <input value="{{ old('name',$roles->name) }}" name="name" placeholder="Enter Name" type="text"
                           class="border-gray-300 shadow-sm w-1/2 rounded-lg ms-1">
                           @error('name')
                           <p class="text-red-400 font-medium">{{$message}}</p>
                           @enderror
                      </div>

                       <div class="grid grid-cols-2 mb-3">

                            @if ($permissions ->isNotEmpty())
                                    @foreach ($permissions as $permission )
                                        <div class="mt-3 ">
                                            <!-- checked or not -->
                                            <input {{($haspermissions->contains($permission->name) ? 'checked' : '' )}} type="checkbox" id="permission-{{$permission->id}}" class="rounded" name="permission[]"
                                            value="{{$permission->name}}">
                                            <label for="permission-{{$permission->id}}">{{$permission->name}}</label>
                                        </div>
                                    @endforeach

                            @endif
                      </div>

                      <button class="btn btn-primary btn-sm  rounded-md text-black px-2 py-1 ms-1">Update</button>

                    </div>
                 </form>

                </div>
            </div>
        </div>
    </div>




<!-- list of permissions -->














@endsection


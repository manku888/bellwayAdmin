@extends('layouts.admin')

@section('content')

<h3>Users / edit</h3>
<a href="{{ route('user.index') }}" >list of users</a>

<!-- create permistions -->
<div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                 <form  action="{{route('user.update', $users->id)}}" method="post">
                  @csrf
                    <div>
                        <label for="" class="text-lg font-medium">Name</label>
                      <div class="my-3">
                           <input value="{{ old('name',$users->name) }}" name="name" placeholder="Enter Name" type="text"
                           class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                           @error('name')
                           <p class="text-red-400 font-medium">{{$message}}</p>
                           @enderror
                      </div>

                      <!-- email -->
                      <label for="" class="text-lg font-medium">Email</label>
                      <div class="my-3">
                           <input value="{{ old('email',$users->email) }}" name="email" placeholder="Enter Email" type="text"
                           class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                           @error('email')
                           <p class="text-red-400 font-medium">{{$message}}</p>
                           @enderror
                      </div>

                       <div class="grid grid-cols-2 mb-3">

                            @if ($roles ->isNotEmpty())
                                    @foreach ($roles as $role )
                                        <div class="mt-3 ">
                                            <!-- checked or not -->


                                            <input {{($hasRoles->contains($role->id) ? 'checked' : '' )}} type="checkbox" id="role-{{$role->id}}" class="rounded" name="role[]"
                                            value="{{$role->name}}">
                                            <label for="role-{{$role->id}}">{{$role->name}}</label>
                                        </div>
                                    @endforeach

                            @endif
                      </div>

                      <button class="bg-slate-700 text-sm rounded-md text-black px-2 py-1">Update</button>

                    </div>
                 </form>

                </div>
            </div>
        </div>
    </div>




<!-- list of permissions -->














@endsection


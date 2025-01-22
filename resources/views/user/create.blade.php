@extends('layouts.admin')

@section('content')

<h3>users / create</h3>
<div class="d-flex justify-content-end mb-3">

    <a href="{{ route('user.index') }}"  class="btn btn-secondary btn-sm">list of users</a>
</div>

<!-- create permistions -->
<div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                 <form action="{{route('user.store')}}" method="post">
                  @csrf
                    <div>
                        <!-- name -->
                        <label for="" class="text-lg font-medium">Name</label>
                      <div class="my-3">
                           <input value="{{ old('name') }}" name="name" placeholder="Enter Name" type="text"
                           class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                           @error('name')
                           <p class="text-red-400 font-medium">{{$message}}</p>
                           @enderror
                      </div>

                       <!-- email -->
                      <label for="" class="text-lg font-medium">Email</label>
                      <div class="my-3">
                           <input value="{{ old('email') }}" name="email" placeholder="Enter Email" type="text"
                           class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                           @error('email')
                           <p class="text-red-400 font-medium">{{$message}}</p>
                           @enderror
                      </div>


                       <!-- password -->
                       <div >
                       <label for="" class="text-lg font-medium">Password</label>
                       <div class="my-3  ">
                           <input value="{{ old('password') }}" name="password" placeholder="Enter Password" type="text"
                           class="border-gray-300 shadow-sm w-1/2 rounded-lg">

                           <!-- <button type="button" class="btn btn-light btn-sm position-absolute top-50 end-0 translate-middle-y me-1" id="togglePassword" style="border: none;">
                                 <i class="fa fa-eye" id="showIcon" style="display: none;"></i>
                                 <i class="fa fa-eye-slash" id="hideIcon"></i>
                            </button> -->

                           @error('password')
                           <p class="text-red-400 font-medium">{{$message}}</p>
                           @enderror

                      </div>
                      </div>


                       <!--  confirm_password -->
                       <label for="" class="text-lg font-medium">Confirm Password</label>
                      <div class="my-3">
                           <input value="{{ old('confirm_password') }}" name="confirm_password" placeholder="Enter Confirm Password" type="text"
                           class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                           @error('confirm_password')
                           <p class="text-red-400 font-medium">{{$message}}</p>
                           @enderror
                      </div>

                      <div class="d-flex flex-wrap">

                            @if ($roles ->isNotEmpty())
                                    @foreach ($roles as $role )
                                        <div class="mt-3 ms-2 me-4 mb-3 ">
                                            <!-- checked or not -->


                                            <input  type="checkbox" id="role-{{$role->id}}" class="rounded" name="role[]"
                                            value="{{$role->name}}">
                                            <label for="role-{{$role->id}}">{{$role->name}}</label>
                                        </div>
                                    @endforeach

                            @endif
                      </div>



                      <button class="btn btn-primary text-sm rounded-md text-black px-2 py-1 ms-1 mb-1">Create</button>

                    </div>
                 </form>

                </div>
            </div>
        </div>
    </div>




<!-- list of permissions -->














@endsection


@extends('layouts.admin')

@section('content')
<h3> Create Permissions</h3>

<div class="d-flex justify-content-end me-3">

    <a href="{{ route('permissions.index') }}" class="btn btn-secondary btn-sm" > permissions-list</a>
</div>

<!-- create permistions -->
<div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                 <form action="{{route('permissions.store')}}" method="post">
                  @csrf
                    <div>
                        <label for="" class="text-lg font-medium ms-1">Name</label>
                      <div class="my-3">
                           <input value="{{ old('name') }}" name="name" placeholder="Enter Name" type="text"
                           class="border-gray-300 shadow-sm w-1/2 rounded-lg ms-1">
                           @error('name')
                           <p class="text-red-400 font-medium">{{$message}}</p>
                           @enderror
                      </div>
                      <button class="btn btn-primary btn-sm ms-1">Submit</button>

                    </div>
                 </form>

                </div>
            </div>
        </div>
    </div>




<!-- list of permissions -->


@endsection


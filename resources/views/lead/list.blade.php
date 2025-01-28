
@extends('layouts.admin')

@section('content')

<h3>leads</h3>

<div class="flex justify-between"></div>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <div class="d-flex justify-content-end mb-3" style="width: 100%; ">
        <a href="{{route('lead.create')}}"  class="btn btn-secondary btn-sm"> Add New Lead</a>
       </div>

        <!-- Table -->

            <table class="custom-table " style=" margin-bottom:2px;">
                <thead>
                    <tr class="text-center">
                        <th>Assignee</th>
                        <th>S.NO.</th>
                        <th>Created Date</th>
                        <th>Source</th>
                        <th>Services</th>
                        <th>Budget</th>
                        <th>Full Name</th>
                        <th>Phone Number</th>
                        <th>City</th>
                        <th>Email</th>
                        <th style="width: 400px;">Last Follow Date & Time</th>
                        <th>Status</th>
                        <th class="upcoming-column">Upcoming Follow-Up Date & Time</th>
                        <th>Description</th>
                        <th>Follow Up</th>
                        <th>Action</th>
                        <th>History</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leads as $lead)
                    <tr>
                        <td>
                            <span class="badge rounded-pill" style="background-color:rgb(173, 27, 206); color: white;">
                                {{ $lead->assignee }}
                            </span>
                        </td>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{date('d-m-Y g:i A',strtotime( $lead->created_at))}}</td>
                        <td>
                            <span class="badge rounded-pill"
                                style="background-color: #0A53A8; color: white;">{{ $lead->source }}
                            </span>
                        </td>
                        <td>{{ $lead->service }}</td>
                        <td>{{ $lead->budget }}</td>
                        <td>{{ $lead->full_name }}</td>
                        <td>{{ $lead->phone_number }}</td>
                        <td>{{ $lead->city }}</td>
                        <td>{{ $lead->email }}</td>
                        <td>{{date('d-m-Y g:i A', strtotime( $lead->created_at))}}</td>
                        <td>
                            <span class="badge rounded-pill" style="background-color: #CE1B84; color: white;">
                                {{ $lead->status }}
                            </span>
                        </td>
                        <td class="text-center">
                        <span>
                             {{ $lead->follow_up_date ? \Carbon\Carbon::parse($lead->follow_up_date)->setTimezone('Asia/Kolkata')->format('d-m-Y g:i A') : '' }}
                        </span>


                        </td>
                        <td>{{ $lead->description }}</td>
                        <td>
                            <!-- @if ($lead->created_at > $lead->follow_up_date)
                                <span class="badge rounded-pill" style="background-color: blue; color: white;">pending</span>
                            @elseif ($lead->last_follow_up_date == $lead->follow_up_date)
                                <span class="badge rounded-pill" style="background-color: green; color: white;">Done</span>
                            @else
                                <span class="badge rounded-pill" style="background-color: red; color: white;">up-comming</span>
                            @endif -->


                            @if ($lead->follow_up_date > now())
                            <span class="badge rounded-pill" style="background-color: red; color: white;">up-comming</span>
                            @else
                            <span class="badge rounded-pill" style="background-color: blue; color: white;">pending</span>
                            @endif


                        </td>



                        <td>
                               <div class="btn-group" role="group">

                                <!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>edit>>>>>>>>>>>>>>>>>>>>>>>>>> -->
                                <a href="{{ route('lead.edit', $lead->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fa-solid fa-pen "></i>
                                </a>
                                <!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>edit>>>>>>>>>>>>>>>>>>>>>>>>>> -->

                                <!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>eye>>>>>>>>>>>>>>>>>>>>>>>>>> -->
                                <a href="{{route('lead.viewedit',$lead->id)}}" class="text-primary " >
                                    <button class="btn btn-primary  btn-sm">
                                    <i class="fas fa-eye"></i>
                                   </button>
                                </a>
                                <!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>eye>>>>>>>>>>>>>>>>>>>>>>>>>> -->


                            </div>
                        </td>
                        <td>


                            <a href="{{route('lead.history',$lead->id)}}" >
                                    <button class="btn btn-primary  btn-sm">
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                   </button>
                                </a>
                        </td>
                    </tr>





                    <!-- -->



                    @endforeach
                </tbody>
            </table>



</ddi

@endsection



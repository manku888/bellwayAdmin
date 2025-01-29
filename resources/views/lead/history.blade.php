@extends('layouts.admin')

@section('content')

<h3>history</h3>

<div class="flex justify-between">



        <!-- Table -->

            <table class="custom-table mt-4 text-nowrap">
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
                        <th>follow_up</th>
                        <th style="width: 400px;">Last Follow Date & Time</th>
                        <th>Status</th>
                        <th class="upcoming-column">Follow-Up Date & Time</th>
                        <th>Description</th>
                        <th>Status Follow Up</th>


                    </tr>
                </thead>
                <tbody>
                    @foreach($leadhistorys as $leadhistory)
                    <tr>
                        <td>
                            <span class="badge rounded-pill bg-success" >
                                {{ $leadhistory->assignee }}
                            </span>
                        </td>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{date('d-m-Y g:i A',strtotime( $leadhistory->created_at))}}</td>
                        <td>
                            <span class="badge rounded-pill"
                                style="background-color: #0A53A8; color: white;">{{ $leadhistory->source }}
                            </span>
                        </td>
                        <td>{{ $leadhistory->service }}</td>
                        <td>{{ $leadhistory->budget }}</td>
                        <td>{{ $leadhistory->full_name }}</td>
                        <td>{{ $leadhistory->phone_number }}</td>
                        <td>{{ $leadhistory->city }}</td>
                        <td>{{ $leadhistory->email }}</td>
                        <td >
                            <span class="badge rounded-pill bg-success">{{$leadhistory->follow_up}}
                        </span>
                        </td>
                        <td>{{date('d-m-Y g:i A', strtotime( $leadhistory->created_at))}}</td>
                        <td>
                            <span class="badge rounded-pill bg-danger" >
                                {{ $leadhistory->status }}
                            </span>
                        </td>
                        <td class="text-center">
                        <span>
                             {{ $leadhistory->follow_up_date ? \Carbon\Carbon::parse($leadhistory->follow_up_date)->setTimezone('Asia/Kolkata')->format('d-m-Y g:i A') : '' }}
                        </span>


                        </td>
                        <td>{{ $leadhistory->description }}</td>
                        <td>
                            @if ($leadhistory->follow_up_date > now())
                            <span leadhistory="badge rounded-pill bg-danger" >up-comming</span>
                            @else
                            <span leadhistory="badge rounded-pill bg-warning" >pending</span>
                            @endif
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>

</div>

@endsection

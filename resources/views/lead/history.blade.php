@extends('layouts.admin')

@section('content')

<h3>history</h3>
<div class="d-flex justify-content-end ">

<a href="{{ route('lead.index') }}" class="btn btn-secondary btn-sm mb-3">Back</a>
</div>
<div class="flex justify-between">







            <!-- Table -->

    <table class="custom-table mt-4 text-nowrap">
        <thead class="bg-light">
            <tr class="text-center">
                        <th>Assignee</th>
                        <th>Updated By</th>
                        <th>S.NO.</th>
                        <th>Created Date</th>
                        <th>Source</th>
                        <th>Services</th>
                        <th>Budget</th>
                        <th>Full Name</th>
                        <th>Phone Number</th>
                        <th>City</th>
                        <th>Email</th>

                        <!-- <th style="width: 400px;">Last Follow Date & Time</th> -->
                        <th>Status</th>
                        <th class="upcoming-column">Follow-Up Date & Time</th>
                        <th>Description</th>
                        <th> Follow Up Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leadhistorys as $leadhistory)
            <tr class="{{ $loop->odd ? 'bg-white' : 'bg-offwhite' }}">
                <td>
                    <span class="badge rounded-pill bg-success">
                        {{ $leadhistory->assignee }}
                    </span>
                </td>
                <td>{{ $leadhistory->edit_by}}</td>
                <td>{{ $loop->iteration }}</td>
                <td>{{ date('d-m-Y g:i A', strtotime($leadhistory->created_at)) }}</td>
                <td>
                    <span class="badge rounded-pill" style="background-color: #0A53A8; color: white;">
                        {{ $leadhistory->source }}
                    </span>
                </td>
                <td>{{ $leadhistory->service }}</td>
                <td>{{ $leadhistory->budget }}</td>
                <td>{{ $leadhistory->full_name }}</td>
                <td>{{ $leadhistory->phone_number }}</td>
                <td>{{ $leadhistory->city }}</td>
                <td>{{ $leadhistory->email }}</td>
                <!-- <td>
                    <span class="badge rounded-pill bg-success">{{ $leadhistory->follow_up }}</span>
                </td> -->
                <!-- <td>{{ date('d-m-Y g:i A', strtotime($leadhistory->created_at)) }}</td> -->
                <td>
                    <span class="badge rounded-pill bg-danger">
                        {{ $leadhistory->status }}
                    </span>
                </td>
                <td class="text-center">
                    <span>
                        {{ $leadhistory->follow_up_date ? \Carbon\Carbon::parse($leadhistory->follow_up_date)->setTimezone('Asia/Kolkata')->format('d-m-Y g:i A') : '' }}
                    </span>
                </td>
                <td>{{ $leadhistory->description }}</td>
                <!-- <td>
                    @if ($leadhistory->follow_up_date > now())
                    <span class="badge rounded-pill bg-danger">up-coming</span>
                    @else
                    <span class="badge rounded-pill bg-warning">pending</span>
                    @endif
                </td> -->

                <td >
                            <span class="badge rounded-pill bg-success" style="width: 100px;">{{$leadhistory->follow_up}}
                        </span>
                        </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <style>
        /*  Custom Background Colors  */
        .bg-offwhite {
            background-color: whitesmoke !important;
             /* off-white color */
        }

        .bg-light {
            background-color: #f0f0f0 !important;
             /* light gray for thead  */
        }
    </style>

</div>

@endsection

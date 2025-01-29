
@extends('layouts.admin')

@section('content')

<div class="flex justify-between">

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

        <!-- <div class="d-flex justify-content-end mb-3" style="width: 100%; ">
        <a href="{{route('lead.create')}}"  class="btn btn-secondary btn-sm"> Add New Lead</a>
       </div> -->

       <div class="d-flex justify-content-between align-items-center position-fixed   " style="width:80vw; top: 80px; z-index: 1000;">
        <button type="button" class="btn btn-outline-secondary hover:bg-black">
            <i class="fa-solid fa-file-export"></i> Export
        </button>

        <select id="dateFilter" class="form-select w-25">
            <option value="">Filter by Date</option>
            <option value="today">Today</option>
            <option value="last30days">Last 30 Days</option>
            <option value="last90days">Last 90 Days</option>
            <option value="last6months">Last 6 Months</option>
            <option value="lastmonth">Last Month</option>
            <option value="thismonth">This Month</option>
            <option value="lastyear">Last Year</option>
            <option value="customrange">Custom Range</option>
        </select>

        <div id="customDateRange" class="d-none">
            <input type="date" id="startDate" class="form-control" placeholder="Start Date">
            <input type="date" id="endDate" class="form-control" placeholder="End Date">
        </div>

        <div class="input-group w-25">
            <span class="input-group-text">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <input type="search" id="searchInput" placeholder="Start typing to search" class="form-control">
        </div>

        <a href="{{ route('lead.create') }}" class="btn btn-primary btn-sm">
            <i class="fa-solid fa-plus"></i> Add New Lead
        </a>
        <button class="btn btn-outline-secondary" id="filter">
            <i class="fa-solid fa-filter"></i> Filters
        </button>
    </div>

        <!-- Table -->
<div class="table-responsive" style="margin-top: 100px;">

    <table class="custom-table table table-striped table-bordered text-nowrap" id="table">
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
                <th class="upcoming-column">Follow-Up Date & Time</th>
                <th>Description</th>
                <th>Status Follow Up</th>
                <th>Action</th>
                <th>History</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leads as $lead)
            <tr>
                <td class="assignee">
                    <span class="badge rounded-pill bg-success" >
                        {{ $lead->assignee }}
                    </span>
                </td>
                <td>{{ $loop->iteration }}</td>
                <td>{{date('d-m-Y g:i A',strtotime( $lead->created_at))}}</td>
                <td class="source">
                    <span class="badge rounded-pill"
                        style="background-color: #0A53A8; color: white;">{{ $lead->source }}
                    </span>
                </td>
                <td class="service">{{ $lead->service }}</td>
                <td>{{ $lead->budget }}</td>
                <td class="fullname">{{ $lead->full_name }}</td>
                <td class="phonenumber">{{ $lead->phone_number }}</td>
                <td class="city">{{ $lead->city }}</td>
                <td class="email">{{ $lead->email }}</td>
                <td>{{date('d-m-Y g:i A', strtotime( $lead->created_at))}}</td>
                <td class="status">
                    <span class="badge rounded-pill bg-danger" >
                        {{ $lead->status }}
                    </span>
                </td>
                <td class="text-center">
                <span>
                     {{ $lead->follow_up_date ? \Carbon\Carbon::parse($lead->follow_up_date)->setTimezone('Asia/Kolkata')->format('d-m-Y g:i A') : '' }}
                </span>


                </td>
                <td>{{ $lead->description }}</td>
                <td class="statusfollowup">
                    <!-- @if ($lead->created_at > $lead->follow_up_date)
                        <span class="badge rounded-pill" style="background-color: blue; color: white;">pending</span>
                    @elseif ($lead->last_follow_up_date == $lead->follow_up_date)
                        <span class="badge rounded-pill" style="background-color: green; color: white;">Done</span>
                    @else
                        <span class="badge rounded-pill" style="background-color: red; color: white;">up-comming</span>
                    @endif -->


                    @if ($lead->follow_up_date > now())
                    <span class="badge rounded-pill bg-danger" >up-comming</span>
                    @else
                    <span class="badge rounded-pill bg-warning" >pending</span>
                    @endif


                </td>



                <td>
                       <div class="btn-group d-flex gap-3" role="group">

                        <!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>edit>>>>>>>>>>>>>>>>>>>>>>>>>> -->

                                                               <!-- Button trigger modal -->
                                                              <!-- Trigger Button -->
                                    <a type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    data-id="{{ $lead->id }}" data-service="{{ $lead->services }}"
                                    data-description="{{ $lead->descriptions }}" data-follow-up="{{ $lead->follow_up_date }}"
                                    data-status="{{ $lead->status }}">
                                        <i class="fa-solid fa-pen text-primary"></i>
                                    </a>

                        <!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>edit>>>>>>>>>>>>>>>>>>>>>>>>>> -->

                        <!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>eye>>>>>>>>>>>>>>>>>>>>>>>>>> -->
                        <a href="{{route('lead.viewedit',$lead->id)}}"  >

                            <i class="fas fa-eye text-black"></i>

                        </a>
                        <!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>eye>>>>>>>>>>>>>>>>>>>>>>>>>> -->

                        <!-- delete -->
                        <form action="{{route('lead.destroy',$lead->id)}}" method="post" >
                 @csrf
                 @method('delete')

                 <button type="submit" class="btn  btn-sm" onclick="return confirm('Are you sure you want to delete this hiring data?')">
                            <i class="fa-solid fa-trash " style="color: red;"></i>
                        </button>
                </form>

                        <!-- delete -->

                    </div>
                </td>
                <td class="text-center">
                    <a href="{{route('lead.history',$lead->id)}}" >
                         <i class="fa-solid fa-clock-rotate-left text-success"> </i>
                     </a>
                </td>
            </tr>





            <!-- -->



            @endforeach
        </tbody>
    </table>
</div>



</div>


<!-- Edit Modal
<div class="modal fade" id="editLeadModal" tabindex="-1" aria-labelledby="editLeadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLeadModalLabel">Edit Lead</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editLeadForm" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="lead_id" id="lead_id">

                    <div class="mb-3">
                        <label for="edit_lead" class="form-label">Lead</label>
                        <input type="text" class="form-control" id="edit_lead" name="lead">
                    </div>

                    <div class="mb-3">
                        <label for="edit_services" class="form-label">Services</label>
                        <input type="text" class="form-control" id="edit_services" name="services">
                    </div>

                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Description</label>
                        <textarea class="form-control" id="edit_description" name="description"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="edit_follow_up_date" class="form-label">Follow-Up Date</label>
                        <input type="datetime-local" class="form-control" id="edit_follow_up_date" name="follow_up_date">
                    </div>

                    <div class="mb-3">
                        <label for="edit_status" class="form-label">Status</label>
                        <select class="form-select" id="edit_status" name="status">
                            <option value="Pending">Pending</option>
                            <option value="Completed">Completed</option>
                            <option value="In Progress">In Progress</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Lead</button>
                </form>
            </div>
        </div>
    </div>
</div> -->


<!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>. -->
 <!-- Button trigger modal -->


<!-- Modal -->
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    <form action="">

    </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>

    </div>
  </div>
</div> -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Lead</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="updateLeadForm" method="POST">
          @csrf
          @method('POST')

          <!-- Hidden Lead ID -->
          <input type="hidden" id="lead_id" name="lead_id" value="">

          <!-- Services Field -->
          <div class="mb-3">
            <label for="services" class="form-label">Service</label>
            <select class="form-control" id="services" name="service">
                <option value="Consultation">Consultation</option>
                <option value="Development">Development</option>
                <option value="Support">Support</option>
                <option value="Marketing">Marketing</option>
            </select>
          </div>

          <!-- Descriptions Field -->
          <div class="mb-3">
            <label for="descriptions" class="form-label">Descriptions</label>
            <textarea class="form-control" id="descriptions" name="description" rows="3"></textarea>
          </div>

          <!-- Follow Up Date Field -->
          <div class="mb-3">
            <label for="follow_up_date" class="form-label">Follow Up Date</label>
            <input type="datetime-local" class="form-control" id="follow_up_date" name="follow_up_date">
          </div>

          <!-- Status Field -->
          <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="enquiry">enquiry</option>
                <option value="npc">npc</option>
                <option value="not">not</option>
                <option value="fake">fake</option>
                <option value="interested">interested</option>
                <option value="closedwith">closedwith</option>
                <option value="language">language</option>
                <option value="low">low</option>
                <option value="caf">caf</option>
                <option value="postponed">postponed</option>
                <option value="closed">closed</option>
            </select>
          </div>

          <!-- Submit Button -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update Lead</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>

  // Populate Modal with Data on Button Click
  document.querySelectorAll('[data-bs-target="#exampleModal"]').forEach(button => {
    button.addEventListener('click', function () {
      const leadId = this.getAttribute('data-id');
      const service = this.getAttribute('data-service');
      const description = this.getAttribute('data-description');
      const followUp = this.getAttribute('data-follow-up');
      const status = this.getAttribute('data-status');

      // Set form action dynamically
      const form = document.getElementById('updateLeadForm');
      form.action = `/admin/lead/${leadId}`;

      // Populate modal fields
      document.getElementById('lead_id').value = leadId;
      document.getElementById('services').value = service || ''; // Ensure non-null value
      document.getElementById('descriptions').value = description || ''; // Ensure non-null value
      document.getElementById('follow_up_date').value = followUp || ''; // Ensure non-null value
      document.getElementById('status').value = status || ''; // Ensure non-null value
    });
  });








//   global search
document.getElementById('searchInput').addEventListener('input', function() {
        const searchQuery = this.value.toLowerCase(); // Get the search query
        const rows = document.querySelectorAll('#table tbody tr'); // Select all rows

        rows.forEach(row => {
            // Fetch the text content of the target columns
            const assignee = row.querySelector('.assignee').textContent.toLowerCase();
            const source = row.querySelector('.source').textContent.toLowerCase();
            const service = row.querySelector('.service').textContent.toLowerCase();
            const fullname = row.querySelector('.fullname').textContent.toLowerCase();
            const phonenumber = row.querySelector('.phonenumber').textContent.toLowerCase();
            const city = row.querySelector('.city').textContent.toLowerCase();
            const email = row.querySelector('.email').textContent.toLowerCase();
            const status = row.querySelector('.status').textContent.toLowerCase();
            const statusfollowup = row.querySelector('.statusfollowup').textContent.toLowerCase();

            // Show/Hide the row based on the search query
            if (assignee.includes(searchQuery) || source.includes(searchQuery) || service.includes(searchQuery) || fullname.includes(searchQuery) || phonenumber.includes(searchQuery) || city.includes(searchQuery) || email.includes(searchQuery) || status.includes(searchQuery) || statusfollowup.includes(searchQuery)) {
                row.style.display = ''; // Show the row
            } else {
                row.style.display = 'none'; // Hide the row
            }
        });
    });
</script>


@endsection



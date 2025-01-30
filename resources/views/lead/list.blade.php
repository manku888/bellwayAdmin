
@extends('layouts.admin')

@section('content')

<div class="flex justify-between">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: "{{ session('success') }}",
            timer: 3000,
            showConfirmButton: false
        });
    });
</script>
@endif

@if(session('error'))
<script>
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: "{{ session('error') }}",
            timer: 3000,
            showConfirmButton: false
        });
    });
</script>
@endif
<!-- Add this script for auto-dismissal -->
<script>
    // Function to display the toast notification and automatically dismiss after 3 seconds
    document.addEventListener("DOMContentLoaded", function() {
        // Check if there is any success or error message
        const successToast = document.getElementById('successToast');
        const errorToast = document.getElementById('errorToast');
        const toastContainer = document.getElementById('toastContainer');

        // Display the toast container if there is any toast to show
        if (successToast || errorToast) {
            toastContainer.style.display = 'block';

            // Show success toast
            if (successToast) {
                const toast = new bootstrap.Toast(successToast);
                toast.show();
            }

            // Show error toast
            if (errorToast) {
                const toast = new bootstrap.Toast(errorToast);
                toast.show();
            }

            // Hide toast container after 3 seconds
            setTimeout(() => {
                toastContainer.style.display = 'none';
            }, 3000);
        }
    });
</script>


<!-- nav bar Import , export, search -->
       <div class="d-flex justify-content-between align-items-center position-fixed  bg-light p-2 rounded " style="width:81vw; top: 55px; z-index: 1000;">
        <button type="button" class="btn btn-outline-secondary hover:bg-black">
            <i class="fa-solid fa-file-export"></i> Export
        </button>
        <button type="button" class="btn btn-outline-secondary hover:bg-black">
            <i class="fa-solid fa-file-import"></i> Import
        </button>
        <!-- TODO last month this month last year custom range -->
        <select id="dateFilter" class="form-select w-25">
            <option value="">Filter by Date</option>
            <option value="today">Today</option>
            <option value="last30days">Last 30 Days</option>
            <option value="last90days">Last 90 Days</option>
            <option value="last6months">Last 6 Months</option>
            <option value="lastmonth">Last Month</option>
            <option value="thismonth">This Month</option>
            <option value="lastyear">Last Year</option>
            <!-- <option value="customrange">Custom Range</option> -->
        </select>
        <!-- created date filter -->
        <script>
            document.getElementById('dateFilter').addEventListener('change', function() {
                const filterValue = this.value;
                const rows = document.querySelectorAll('#table tbody tr');
                const today = new Date();
                const last30Days = getPastDate(30);
                const last90Days = getPastDate(90);
                const last6Months = getPastDate(180);
                const firstOfThisMonth = getFirstOfThisMonth();
                const firstOfLastMonth = getFirstOfLastMonth();
                const lastOfLastMonth = getLastOfLastMonth();
                const firstOfLastYear = getFirstOfLastYear();
                const lastOfLastYear = getLastOfLastYear();

                console.log(`%c Selected Filter: ${filterValue}`, "background: green; color: white; padding: 5px; border-radius: 5px;");

                rows.forEach(row => {
                    const createdAtCell = row.querySelector('td:nth-child(4)');
                    if (!createdAtCell) return;

                    const rowDate = createdAtCell.textContent.trim().split(" ")[0];
                    let showRow = false;

                    switch (filterValue) {
                        case "today":
                            showRow = rowDate === formatDate(today);
                            console.log("Showing results of today:", formatDate(today));
                            break;
                        case "last30days":
                            showRow = isWithinRange(rowDate, last30Days);
                            console.log("Last 30 Days:", formatDate(last30Days), "to", formatDate(today));
                            break;
                        case "last90days":
                            showRow = isWithinRange(rowDate, last90Days);
                            console.log("Last 90 Days:", formatDate(last90Days), "to", formatDate(today));
                            break;
                        case "last6months":
                            showRow = isWithinRange(rowDate, last6Months);
                            console.log("Last 180 Days:", formatDate(last6Months), "to", formatDate(today));
                            break;
                        case "thismonth":
                            showRow = isWithinRange(rowDate, firstOfThisMonth);
                            console.log("This Month:", formatDate(firstOfThisMonth), "to", formatDate(today));
                            break;
                        case "lastmonth":
                            showRow = isWithinRange(rowDate, firstOfLastMonth, lastOfLastMonth);
                            console.log("Last Month:", formatDate(firstOfLastMonth), "to", formatDate(lastOfLastMonth));
                            break;
                        case "lastyear":
                            showRow = isWithinRange(rowDate, firstOfLastYear, lastOfLastYear);
                            console.log("Last Year:", formatDate(firstOfLastYear), "to", formatDate(lastOfLastYear));
                            break;
                    }

                    row.style.display = showRow ? '' : 'none';
                });
            });

            // ✅ Function to format a Date object as "DD-MM-YYYY"
            function formatDate(date) {
                if (!(date instanceof Date)) return date; // Ensure date is a Date object
                const day = String(date.getDate()).padStart(2, '0');
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const year = date.getFullYear();
                return `${day}-${month}-${year}`;
            }

            // ✅ Function to get past date as a Date object
            function getPastDate(days) {
                const date = new Date();
                date.setDate(date.getDate() - days);
                return date;
            }

            // ✅ Function to get first day of this month
            function getFirstOfThisMonth() {
                return new Date(new Date().getFullYear(), new Date().getMonth(), 1);
            }

            // ✅ Function to get first day of last month
            function getFirstOfLastMonth() {
                return new Date(new Date().getFullYear(), new Date().getMonth() - 1, 1);
            }

            // ✅ Function to get last day of last month
            function getLastOfLastMonth() {
                return new Date(new Date().getFullYear(), new Date().getMonth(), 0);
            }

            // ✅ Function to get first day of last year
            function getFirstOfLastYear() {
                return new Date(new Date().getFullYear() - 1, 0, 1);
            }

            // ✅ Function to get last day of last year
            function getLastOfLastYear() {
                return new Date(new Date().getFullYear() - 1, 11, 31);
            }

            // ✅ Function to check if row date is within a given range
            function isWithinRange(rowDate, startDate, endDate = new Date()) {
                const [day, month, year] = rowDate.split("-").map(Number);
                const rowDateObj = new Date(year, month - 1, day); // Convert "DD-MM-YYYY" to Date object

                return rowDateObj >= startDate && rowDateObj <= endDate;
            }
        </script>

        <div class="input-group w-25">
            <span class="input-group-text">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <input type="search" id="searchInput" placeholder="Start typing to search" class="form-control">
            <script>
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
        </div>

        <a href="{{ route('lead.create') }}" class="btn btn-primary btn-sm">
            <i class="fa-solid fa-plus"></i> Add New Lead
        </a>
        <button class="btn btn-outline-secondary" id="filter">
            <i class="fa-solid fa-filter"></i> Filters
        </button>
    </div>

    <!-- filter side bar -->
     <!-- Filter Bar -->

    <div class="filter-bar h-100 position-fixed p-4 overflow-scroll" id="filterBar"
        style="width:30vw; top: 0; right: -30vw; z-index: 9999; background-color: rgb(250, 250, 250, 0.7);
     backdrop-filter: blur(15px); border-top-left-radius: 10px; border-bottom-right-radius: 10px;">

        <div class="filter-bar-header d-flex justify-content-between align-items-center">
            <h5>Filters</h5>
            <button class="btn-close bg-white p-2" id="closeFilterBar"></button>
        </div>

        <!-- Filter Form -->
        <form action="" class="mt-3">
            <!-- Assignee -->
            <div class="mb-3">
                <label for="assignee" class="form-label">Assignee</label>
                <input type="text" class="form-control" id="assignee" placeholder="Enter assignee's name">
            </div>

            <!-- Created Date -->
            <div class="mb-3">
                <label for="createdDate" class="form-label">Created Date</label>
                <input type="date" class="form-control" id="createdDate">
            </div>

            <!-- Service -->
            <div class="mb-3">
                <label for="service" class="form-label">Service</label>
                <input type="text" class="form-control" id="service" placeholder="Enter service type">
            </div>

            <!-- Source -->
            <div class="mb-3">
                <label for="source" class="form-label">Source</label>
                <input type="text" class="form-control" id="source" placeholder="Enter source">
            </div>

            <!-- City -->
            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" placeholder="Enter city">
            </div>

            <!-- Follow-up Date -->
            <div class="mb-3">
                <label for="followUpDate" class="form-label">Follow-up Date</label>
                <input type="date" class="form-control" id="followUpDate">
            </div>

            <!-- Follow-up Status -->
            <div class="mb-3">
                <label for="followUpStatus" class="form-label">Follow-up Status</label>
                <select class="form-control" id="followUpStatus">
                    <option value="">Select status</option>
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                    <option value="in-progress">In Progress</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
        </form>

        <!-- Script for opening and closing the filter bar -->
        <script>
            document.getElementById('filterBar').style.transition = 'right 0.5s ease-in-out';

            document.getElementById('filter').addEventListener('click', function() {
                document.getElementById('filterBar').style.right = '0';
            });

            document.getElementById('closeFilterBar').addEventListener('click', function() {
                document.getElementById('filterBar').style.right = '-30vw';
            });
        </script>
    </div>

        <!-- Table -->
<div class="table-responsive" style="margin-top: 70px;">

    <table class="custom-table table table-striped table-bordered text-nowrap" id="table">
        <thead class="bg-light">
            <tr class="text-center">
                <th>Assignee</th>
                <th>S.NO.</th>
                <th>Source</th>
                <th>Created Date</th>
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
                <th>Follow Up Status</th>
                <th>Action</th>
                <th>History</th>
            </tr>
        </thead>
        <tbody>
        @php
            $sno = ($leads->currentPage() - 1) * $leads->perPage() + 1;
        @endphp
            @foreach($leads as $lead)
            <tr  class="{{ $loop->odd ? 'bg-white' : 'custom-bg-offwhite' }} ">
                <td class="assignee">
                    <span class="badge rounded-pill bg-success" >
                        {{ $lead->assignee }}
                    </span>
                </td>

                <td class="text-center">{{ $sno++ }}</td>
                <td class="source badge" style="background-color: {{ $sources[$lead->source] ?? '#fafafa' }}; ">
                        {{ $lead->source }}
               </td>
                <td>{{date('d-m-Y g:i A',strtotime( $lead->created_at))}}</td>


                <td class="service badge" style="background-color: {{ $services[$lead->service] ?? '#fafafa' }}; ">
                        {{ $lead->service }}
               </td>
                <td>{{ $lead->budget }}</td>
                <td class="fullname">{{ $lead->full_name }}</td>
                <td class="phonenumber">{{ $lead->phone_number }}</td>
                <td class="city">{{ $lead->city }}</td>
                <td class="email">{{ $lead->email }}</td>
                <td>{{date('d-m-Y g:i A', strtotime( $lead->created_at))}}</td>
                <td class="status badge" style="background-color: {{ $statuses[$lead->status] ?? '#fafafa' }}; ">

                        {{ $lead->status }}
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
                       <div class="btn-group d-flex gap-3  " role="group">

                        <!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>edit>>>>>>>>>>>>>>>>>>>>>>>>>> -->

                                                               <!-- Button trigger modal -->
                                                              <!-- Trigger Button -->
                                    <a type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    data-id="{{ $lead->id }}" data-service="{{ $lead->service }}"
                                    data-description="{{ $lead->description }}"follow_up_date="{{ $lead->follow_up_date }}"
                                    data-status="{{ $lead->status }}">
                                        <i class="fa-solid fa-pen text-primary"></i>
                                    </a>

                        <!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>edit>>>>>>>>>>>>>>>>>>>>>>>>>> -->

                        <!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>eye>>>>>>>>>>>>>>>>>>>>>>>>>> -->
                        <a href="{{route('lead.viewedit',$lead->id)}}"  >

                            <i class="fas fa-eye text-black ms-1"></i>

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

 <!-- Pagination -->
 <div class="d-flex justify-content-center mt-3">
        {{ $leads->links() }}
    </div>


<!-- table custom classes -->
<style>
         /* Custom Background Colors  */
        .custom-bg-offwhite {
            background-color: whitesmoke !important;

        }

        .bg-light {
            background-color: #f0f0f0 !important;
        }
    </style>

</div>



<!-- >>>>>>>>>>>>>>>>>> edit  >>>>>>>>>>>>>>>>>>>>>>>>. -->



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


<!--model or filters ki scripts  -->
<script>

  // Populate Modal with Data on Button Click
  document.querySelectorAll('[data-bs-target="#exampleModal"]').forEach(button => {
    button.addEventListener('click', function () {
      const leadId = this.getAttribute('data-id');
      const service = this.getAttribute('data-service');
      const description = this.getAttribute('data-description');
      const followUp = this.getAttribute('follow_up_date');
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

//filter
// document.addEventListener("DOMContentLoaded", function() {
//     const dateFilter = document.getElementById("dateFilter");
//     const startDate = document.getElementById("startDate");
//     const endDate = document.getElementById("endDate");
//     const filterButton = document.getElementById("filter");

//     // Toggle custom date range visibility
//     dateFilter.addEventListener("change", function() {
//         if (this.value === "customrange") {
//             document.getElementById("customDateRange").classList.remove("d-none");
//         } else {
//             document.getElementById("customDateRange").classList.add("d-none");
//         }
//     });

//     // Handle filter button click
//     filterButton.addEventListener("click", function() {
//         const dateValue = dateFilter.value;
//         const start = startDate.value;
//         const end = endDate.value;

//         const url = new URL(window.location.href);
//         const params = new URLSearchParams(url.search);

//         // Set the filter parameters in the URL
//         if (dateValue) params.set("date", dateValue);
//         if (start && end) {
//             params.set("start_date", start);
//             params.set("end_date", end);
//         }

//         // Reload the page with new filter parameters
//         window.location.search = params.toString();
//     });
// });








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



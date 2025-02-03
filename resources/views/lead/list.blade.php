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
    <div class="custom-div d-flex flex-column flex-md-row gap-2 justify-content-between align-items-center position-fixed p-2 rounded ">
        <div class="col-12 col-md-6 col-lg-3">
            <button type="button" class="btn btn-outline-secondary hover:bg-black" onclick="window.location.href='{{ route('leads.export')}}'">
                <i class="fa-solid fa-file-export"></i> Export
            </button>
            <button type="button" class="btn btn-outline-secondary hover:bg-black" data-bs-toggle="modal" data-bs-target="#importModal">
                <i class="fa-solid fa-file-import"></i> Import
            </button>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="input-group ">
                <span class="input-group-text">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="search" id="searchInput" placeholder="Start typing to search" class="form-control">
            </div>
            <script>
                document.getElementById('searchInput').addEventListener('input', function() {
                    const searchQuery = this.value.toLowerCase(); // Get the search query
                    const rows = document.querySelectorAll('#table tbody tr'); // Select all rows

                    rows.forEach(row => {
                        const assignee = row.querySelector('.assignee').textContent.toLowerCase();
                        const source = row.querySelector('.source').textContent.toLowerCase();
                        const service = row.querySelector('.service').textContent.toLowerCase();
                        const fullname = row.querySelector('.fullname').textContent.toLowerCase();
                        const phonenumber = row.querySelector('.phonenumber').textContent.toLowerCase();
                        const city = row.querySelector('.city').textContent.toLowerCase();
                        const email = row.querySelector('.email').textContent.toLowerCase();
                        const status = row.querySelector('.status').textContent.toLowerCase();
                        const statusfollowup = row.querySelector('.statusfollowup').textContent.toLowerCase();

                        if (assignee.includes(searchQuery) || source.includes(searchQuery) || service.includes(searchQuery) || fullname.includes(searchQuery) || phonenumber.includes(searchQuery) || city.includes(searchQuery) || email.includes(searchQuery) || status.includes(searchQuery) || statusfollowup.includes(searchQuery)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            </script>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <select id="dateFilter" class="form-select">
                <option value="">Filter by Date</option>
                <option value="today">Today</option>
                <option value="last30days">Last 30 Days</option>
                <option value="last90days">Last 90 Days</option>
                <option value="last6months">Last 6 Months</option>
                <option value="lastmonth">Last Month</option>
                <option value="thismonth">This Month</option>
                <option value="lastyear">Last Year</option>
            </select>
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

                function formatDate(date) {
                    if (!(date instanceof Date)) return date; // Ensure date is a Date object
                    const day = String(date.getDate()).padStart(2, '0');
                    const month = String(date.getMonth() + 1).padStart(2, '0');
                    const year = date.getFullYear();
                    return `${day}-${month}-${year}`;
                }

                function getPastDate(days) {
                    const date = new Date();
                    date.setDate(date.getDate() - days);
                    return date;
                }

                function getFirstOfThisMonth() {
                    return new Date(new Date().getFullYear(), new Date().getMonth(), 1);
                }

                function getFirstOfLastMonth() {
                    return new Date(new Date().getFullYear(), new Date().getMonth() - 1, 1);
                }

                function getLastOfLastMonth() {
                    return new Date(new Date().getFullYear(), new Date().getMonth(), 0);
                }

                function getFirstOfLastYear() {
                    return new Date(new Date().getFullYear() - 1, 0, 1);
                }

                function getLastOfLastYear() {
                    return new Date(new Date().getFullYear() - 1, 11, 31);
                }

                function isWithinRange(rowDate, startDate, endDate = new Date()) {
                    const [day, month, year] = rowDate.split("-").map(Number);
                    const rowDateObj = new Date(year, month - 1, day); // Convert "DD-MM-YYYY" to Date object

                    return rowDateObj >= startDate && rowDateObj <= endDate;
                }
            </script>
        </div>


        <div class="last-buttons  ">
            <a href="{{ route('lead.create') }}" class="btn btn-outline-primary">
                <i class="fa-solid fa-plus"></i> Add New Lead
            </a>
            <button class="btn btn-outline-secondary " id="filter">
                <i class="fa-solid fa-filter"></i> Filters
            </button>
        </div>
    </div>
    <style>
        .custom-div {
            background-color: white;
            width: 82%;
            top: 55px;
            z-index: 1000;
        }

        .table-responsive {
            margin-top: 70px;
        }

        .last-buttons {
            width: 100%;
            display: flex;
            justify-content: space-between;
        }

        @media screen and (max-width: 768px) {
            .custom-div {
                width: 88%;

            }

            .last-buttons {
                width: 100%;
                justify-content: space-between;
            }

            .table-responsive {
                margin-top: 200px;
            }
        }
    </style>

    <!-- filter side bar -->
    <div class="filter-bar h-100 position-fixed p-4 overflow-scroll" id="filterBar"
        style="top: 0; right: -100%; z-index: 9999; background-color: rgba(250, 250, 250, 0.7);
    backdrop-filter: blur(15px); border-top-left-radius: 10px; border-bottom-right-radius: 10px;
    width: 100%; max-width: 400px; transition: right 0.5s ease-in-out;">

        <div class="filter-bar-header d-flex justify-content-between align-items-center">
            <h5>Filters</h5>
            <button class="btn-close bg-white p-2" id="closeFilterBar"></button>
        </div>

        <!-- Filter Form -->
        <form action="{{ route('lead.index') }}" method="GET" class="mt-3" id="filterForm">
            <div class="mb-3">
                <label for="assignee" class="form-label">Assignee</label>
                <select class="form-control" id="assignee" name="assignee">
                    <option value="">Select Assignee</option>
                    @foreach($assignees as $assignee)
                    <option value="{{ $assignee }}" {{ request('assignee') == $assignee ? 'selected' : '' }}>{{ $assignee }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="service" class="form-label">Service</label>
                <select class="form-control" id="service" name="service">
                    <option value="">Select Service</option>
                    @foreach($servicess as $service)
                    <option value="{{ $service }}" {{ request('service') == $service ? 'selected' : '' }}>{{ $service }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="source" class="form-label">Source</label>
                <select class="form-control" id="source" name="source">
                    <option value="">Select Source</option>
                    @foreach($sourcess as $source)
                    <option value="{{ $source }}" {{ request('source') == $source ? 'selected' : '' }}>{{ $source }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Enter city" value="{{ request('city') }}">
            </div>

            <div class="mb-3">
                <label for="statusfollowup" class="form-label">Follow-up Status</label>
                <select class="form-control" id="statusfollowup" name="statusfollowup">
                    <option value="">Select status</option>
                    <option value="pending">Pending</option>
                    <option value="upcoming">Upcoming</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="created_date" class="form-label">Created Date</label>
                <input type="date" class="form-control" id="created_date" name="created_date" value="{{ request('created_date') }}">
            </div>

            <button type="submit" class="btn btn-primary w-100" id="applyFilters">Apply Filters</button>
            <a href="{{ route('lead.index') }}" class="btn btn-secondary w-100 mt-2" id="clearFilters">Clear Filters</a>
        </form>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById('applyFilters').addEventListener('click', function(event) {
                    event.preventDefault();
                    applyFilters();
                });

                document.getElementById('clearFilters').addEventListener('click', function(event) {
                    event.preventDefault();
                    clearFilters();
                });

                function applyFilters() {
                    const filters = {
                        assignee: document.getElementById('assignee').value.toLowerCase(),
                        service: document.getElementById('service').value.toLowerCase(),
                        source: document.getElementById('source').value.toLowerCase(),
                        city: document.getElementById('city').value.toLowerCase(),
                        statusfollowup: document.getElementById('statusfollowup').value.toLowerCase(),
                        created_date: document.getElementById('created_date').value,
                        follow_up_date: document.getElementById('follow_up_date').value
                    };
                    console.log(filters);

                    const rows = document.querySelectorAll('#table tbody tr');

                    rows.forEach(row => {
                        const matches = Object.keys(filters).every(key => {
                            const cell = row.querySelector(`.${key}`);
                            if (key === 'created_date' && filters[key]) {
                                if (cell) {
                                    const [day, month, year] = cell.textContent.split(' ')[0].split('-');
                                    const formattedCellDate = `${year}-${month}-${day}`; // Convert to YYYY-MM-DD
                                    return formattedCellDate === filters[key];
                                }
                                return false;
                            }
                            return !filters[key] || (cell && cell.textContent.toLowerCase().includes(filters[key]));
                        });
                        row.style.display = matches ? '' : 'none';
                    });
                }

                function clearFilters() {
                    document.getElementById('filterForm').reset();
                    const rows = document.querySelectorAll('#table tbody tr');
                    rows.forEach(row => row.style.display = '');
                }
            });
            document.getElementById('filterBar').style.transition = 'right 0.5s ease-in-out';

            document.getElementById('filter').addEventListener('click', function() {
                document.getElementById('filterBar').style.right = '0';
            });

            document.getElementById('closeFilterBar').addEventListener('click', function() {
                document.getElementById('filterBar').style.right = '-100%';
            });
        </script>
    </div>



    <!-- Table -->
    <div class="table-responsive">

    <table class="table table-bordered"
            style="background-color: whitesmoke;  overflow: hidden;">
            <thead class="text-center rounded-top " style="background-color:
#1c99f3; border-top-left-radius: 10px; border-top-right-radius: 10px; color: white;">
                <tr class="text-center">
                    <th class="py-3">Assignee</th>
                    <th>Updated By</th>
                    <th class="py-3">S.NO.</th>
                    <th class="py-3">Source</th>
                    <th class="py-3">Created Date</th>
                    <th class="py-3">Services</th>
                    <th class="py-3">Budget</th>
                    <th class="py-3">Full Name</th>
                    <th class="py-3">Phone Number</th>
                    <th class="py-3">City</th>
                    <th class="py-3">Email</th>
                    <th class="py-3" style="width: 400px;">Last Follow Date & Time</th>
                    <th class="py-3">Status</th>
                    <th class="upcoming-column text-center py-3 ">Follow-Up Date & Time</th>
                    <th class="py-3">Description</th>
                    <th class="py-3">Follow Up Status</th>
                    <th class="py-3">Action</th>
                    <th class="py-3">History</th>

                </tr>
            </thead>
            <tbody class="text-nowrap">
                @php
                $sno = ($leads->currentPage() - 1) * $leads->perPage() + 1;
                @endphp
                @foreach($leads as $lead)
                <tr class="{{ $loop->odd ? 'bg-white' : 'custom-bg-offwhite' }} ">
                <td class="assignee">
                    <span class="badge rounded-pill  py-2" style='width: 100px; display: inline-block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; background-color: {{ $assigneecolors[$lead->assignee ] ?? '#ecb8ff' }}; '>
                        {{ $lead->assignee }}
                    </span>
                </td>
                    <td>{{ $lead->edit_by}}</td>

                    <td class="text-center">{{ $sno++ }}</td>
                    <td class="source">
                        <span class="badge rounded-pill py-2 " style='width: 100px; display: inline-block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; background-color: {{ $sources[$lead->source] ?? '#ecb8ff' }}; '>
                            {{ $lead->source }}
                        </span>
                    </td>
                    <td id="created_date">{{date('d-m-Y g:i A',strtotime( $lead->created_at))}}</td>


                    <td>
                        <span class="service badge rounded-pill py-2" style="width: 100px; display: inline-block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;  background-color: {{ $services[$lead->service] ?? '#7bb8f9' }};">
                            {{ $lead->service }}
                        </span>
                    </td>
                    <td>{{ $lead->budget }}</td>
                    <td class="fullname">{{ $lead->full_name }}</td>
                    <td class="phonenumber">{{ $lead->phone_number }}</td>
                    <td class="city">{{ $lead->city }}</td>
                    <td class="email">{{ $lead->email }}</td>
                    <td class="created_date">{{ date('d-m-Y g:i A', strtotime($lead->created_at)) }}</td>

                    <td>
                        <span class="status badge rounded-pill py-2" style="width: 100px; display: inline-block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;  background-color: {{ $statuses[$lead->status] ?? '#e65656' }}; ">
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

                        @if ($lead->follow_up_date > now())
                        <span class="badge rounded-pill bg-danger py-2" style="width: 100px; display: inline-block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Upcoming</span>
                        @else
                        <span class="badge rounded-pill bg-warning py-2" style="width: 100px; display: inline-block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Pending</span>
                        @endif


                    </td>



                    <td>
                        <div class="btn-group d-flex gap-3  " role="group">

                            <!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>edit>>>>>>>>>>>>>>>>>>>>>>>>>> -->

                            <!-- Button trigger modal -->
                            <!-- Trigger Button -->
                            @can('Edit Lead')
                            <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                data-id="{{ $lead->id }}" data-service="{{ $lead->service }}"
                                data-description="{{ $lead->description }}" follow_up_date="{{ $lead->follow_up_date }}"
                                data-status="{{ $lead->status }}">
                                <i class="fa-solid fa-pen text-primary"></i>
                            </a>
                            @endcan

                            <!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>edit>>>>>>>>>>>>>>>>>>>>>>>>>> -->

                            <!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>eye>>>>>>>>>>>>>>>>>>>>>>>>>> -->
                            <a href="{{route('lead.viewedit',$lead->id)}}">

                                <i class="fas fa-eye text-black ms-1"></i>

                            </a>
                            <!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>eye>>>>>>>>>>>>>>>>>>>>>>>>>> -->

                            <!-- delete -->
                            @can('Delete Lead')
                            <form action="{{route('lead.destroy',$lead->id)}}" method="post">
                                @csrf
                                @method('delete')

                                <button type="submit" class="btn  btn-sm" onclick="return confirm('Are you sure you want to delete this hiring data?')">
                                    <i class="fa-solid fa-trash " style="color: red;"></i>
                                </button>
                            </form>
                            @endcan



                            <!-- delete -->

                        </div>
                    </td>
                    <!-- history -->
                    @can('History Lead')
                    <td class="text-center">
                        <a href="{{route('lead.history',$lead->id)}}">
                            <i class="fa-solid fa-clock-rotate-left text-success"> </i>
                        </a>
                    </td>
                    @endcan
                </tr>





                <!-- -->



                @endforeach
            </tbody>
        </table>

    </div>

    <!-- import export model -->

    <!-- Import Modal -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Leads</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('leads.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="file" class="form-label">Choose Excel File</label>
                            <input type="file" class="form-control" name="file" required accept=".xlsx,.xls">
                            <div class="form-text">Download the <a href="{{ route('leads.export') }}">template</a> for reference</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </form>
            </div>
        </div>
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
                            @foreach ($services as $name => $color)
                            <option value="{{ $name }}" data-color="{{ $color }}">{{ $name }}</option>
                            @endforeach
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
                            @foreach ($statuses as $name => $color)
                            <option value="{{ $name }}" data-color="{{ $color }}">{{ $name }}</option>
                            @endforeach
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
        button.addEventListener('click', function() {
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

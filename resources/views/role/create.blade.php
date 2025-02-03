@extends('layouts.admin')

@section('content')
<div class="container ">
    <div class="d-flex justify-content-between align-items-center py-2">
        <h3 class="">Create Role</h3>
        <a href="{{ route('role.index') }}" class="btn btn-lg"><i class="fas fa-list"> </i> List of Roles</a>
    </div>

    <!-- Role Creation Form -->
    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('role.store') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label h6">Role Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Role Name" value="{{ old('name') }}">
                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="container mt-4">
                    <!-- Leads Section -->
                    <div class="card mb-3">
                        <div class="card-header" style="background-color:
#e6e6e6; color: black; display: flex; justify-content: space-between; align-items: center;">
                            <label for="select-all-leads" class="fw-bold">Leads</label>
                            <div>
                                Select All <input type="checkbox" class="form-check-input select-all" id="select-all-leads" style="margin-left: 10px;">
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="row" id="leads-container"></div>
                        </div>
                    </div>

                    <!-- Roles Section -->
                    <div class="card mb-3">
                        <div class="card-header" style="background-color:
#e6e6e6; color: black; display: flex; justify-content: space-between; align-items: center;">
                            <label for="select-all-roles" class="fw-bold">Roles</label>
                            <div>
                                Select All <input type="checkbox" class="form-check-input select-all" id="select-all-roles" style="margin-left: 10px;">
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="row" id="roles-container"></div>
                        </div>
                    </div>

                    <!-- Permissions Section -->
                    <div class="card mb-3">
                        <div class="card-header" style="background-color:
#e6e6e6; color: black; display: flex; justify-content: space-between; align-items: center;">
                            <label for="select-all-permissions" class="fw-bold">Permissions</label>
                            <div>Select All <input type="checkbox" class="form-check-input select-all" id="select-all-permissions" style="margin-left: 10px;"></div>

                        </div>
                        <div class="card-body">
                            <div class="row" id="permissions-container">
                                @foreach($permissions as $permission)
                                <div class="col-md-3 permission-item">
                                    <div class="form-check">
                                        <input type="checkbox" id="permission-{{ $permission->id }}" name="permission[]" class="form-check-input permission-checkbox" value="{{ $permission->name }}">

                                        <label class="form-check-label" for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- User Section -->
                    <div class="card mb-3">
                        <div class="card-header" style="background-color:
#e6e6e6; color: black; display: flex; justify-content: space-between; align-items: center;">
                            <label for="select-all-user" class="fw-bold">User</label>
                            <div>
                                Select All <input type="checkbox" class="form-check-input select-all" id="select-all-user" style="margin-left: 10px;">
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="row" id="user-container"></div>
                        </div>
                    </div>

                    <!-- Hiring Section -->
                    <div class="card mb-3">
                        <div class="card-header" style="background-color:
#e6e6e6; color: black; display: flex; justify-content: space-between; align-items: center;">
                            <label for="select-all-hiring" class="fw-bold">Hiring</label>
                            <div>
                                Select All <input type="checkbox" class="form-check-input select-all" id="select-all-hiring" style="margin-left: 10px;">
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="row" id="hiring-container"></div>
                        </div>
                    </div>

                    <!-- Queries Section -->
                    <div class="card mb-3">
                        <div class="card-header" style="background-color:
#e6e6e6; color: black; display: flex; justify-content: space-between; align-items: center;">
                            <label for="select-all-queries" class="fw-bold">Queries</label>
                            <div>
                                Select All <input type="checkbox" class="form-check-input select-all" id="select-all-queries" style="margin-left: 10px;">
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="row" id="queries-container"></div>
                        </div>
                    </div>

                    <!-- Vacancies Section -->
                    <div class="card mb-3">
                        <div class="card-header" style="background-color:
#e6e6e6; color: black; display: flex; justify-content: space-between; align-items: center;">
                            <label for="select-all-vacancies" class="fw-bold">Vacancies</label>
                            <div>
                                Select All <input type="checkbox" class="form-check-input select-all" id="select-all-vacancies" style="margin-left: 10px;">
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="row" id="vacancies-container"></div>
                        </div>
                    </div>

                    <!-- Others Section -->
                    <div class="card mb-3">
                        <div class="card-header" style="background-color:
#e6e6e6; color: black; display: flex; justify-content: space-between; align-items: center;">
                            <label for="select-all-others" class="fw-bold">Others</label>
                            <div>

                                Select All <input type="checkbox" class="form-check-input select-all text-black" id="select-all-others" style="margin-left: 10px;">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row" id="others-container"></div>
                        </div>
                    </div>
                </div>

                <!-- JavaScript for Filtering & Select All -->
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        const permissionItems = document.querySelectorAll(".permission-item"); // Select all permission divs
                        const leadsContainer = document.getElementById("leads-container");
                        const rolesContainer = document.getElementById("roles-container");
                        const permissionsContainer = document.getElementById("permissions-container");
                        const userContainer = document.getElementById("user-container");
                        const hiringContainer = document.getElementById("hiring-container");
                        const queriesContainer = document.getElementById("queries-container");
                        const vacanciesContainer = document.getElementById("vacancies-container");
                        const othersContainer = document.getElementById("others-container");

                        const selectAllLeads = document.getElementById("select-all-leads");
                        const selectAllRoles = document.getElementById("select-all-roles");
                        const selectAllPermissions = document.getElementById("select-all-permissions");
                        const selectAllUser = document.getElementById("select-all-user");
                        const selectAllHiring = document.getElementById("select-all-hiring");
                        const selectAllQueries = document.getElementById("select-all-queries");
                        const selectAllVacancies = document.getElementById("select-all-vacancies");
                        const selectAllOthers = document.getElementById("select-all-others");

                        const allCheckboxes = document.querySelectorAll(".permission-checkbox");

                        // Categorizing permissions
                        permissionItems.forEach(item => {
                            const label = item.querySelector(".form-check-label").innerText.toLowerCase(); // Convert to lowercase

                            if (label.includes("lead")) {
                                leadsContainer.appendChild(item); // Move to Leads section
                            } else if (label.includes("role")) {
                                rolesContainer.appendChild(item); // Move to Roles section
                            } else if (label.includes("permission")) {
                                permissionsContainer.appendChild(item); // Move to Permissions section
                            } else if (label.includes("hiring")) {
                                hiringContainer.appendChild(item); // Move to Hiring section
                            } else if (label.includes("vacancy")) {
                                vacanciesContainer.appendChild(item); // Move to Vacancies section
                            } else if (label.includes("queries")) {
                                queriesContainer.appendChild(item); // Move to Queries section
                            } else if (label.includes("user")) {
                                userContainer.appendChild(item); // Move to User section
                            } else {
                                othersContainer.appendChild(item); // Move to Others section
                            }
                        });

                        // Select All functionality for each section
                        selectAllLeads.addEventListener("change", function() {
                            const checkboxes = leadsContainer.querySelectorAll(".permission-checkbox");
                            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
                        });

                        selectAllRoles.addEventListener("change", function() {
                            const checkboxes = rolesContainer.querySelectorAll(".permission-checkbox");
                            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
                        });

                        selectAllPermissions.addEventListener("change", function() {
                            const checkboxes = permissionsContainer.querySelectorAll(".permission-checkbox");
                            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
                        });

                        selectAllUser.addEventListener("change", function() {
                            const checkboxes = userContainer.querySelectorAll(".permission-checkbox");
                            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
                        });

                        selectAllHiring.addEventListener("change", function() {
                            const checkboxes = hiringContainer.querySelectorAll(".permission-checkbox");
                            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
                        });

                        selectAllQueries.addEventListener("change", function() {
                            const checkboxes = queriesContainer.querySelectorAll(".permission-checkbox");
                            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
                        });

                        selectAllVacancies.addEventListener("change", function() {
                            const checkboxes = vacanciesContainer.querySelectorAll(".permission-checkbox");
                            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
                        });

                        selectAllOthers.addEventListener("change", function() {
                            const checkboxes = othersContainer.querySelectorAll(".permission-checkbox");
                            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
                        });
                    });
                </script>





                <div class="text-end">
                    <button type="submit" class="btn btn-outline-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

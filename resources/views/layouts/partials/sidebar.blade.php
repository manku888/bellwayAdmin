<nav class="sb-sidenav accordion sb-sidenav-dark bg-secondary bg-gradient" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading"></div>
                            <a class="nav-link" href="{{url('admin/dashboard')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>

                            <!-- <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Querys
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{url('admin/contact')}}">Contact</a>
                                    <a class="nav-link" href="{{url('admin/trainee')}}">Trainee</a>
                                    <a class="nav-link" href="{{url('admin/experience')}}">Experience</a>
                                </nav>
                            </div> -->
                            @can('Queries')
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Queries
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            @endcan
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                     @can('view contact')
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Contact
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    @endcan
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="{{url('admin/contacts')}}">Contact Sales</a>

                                            @can('view callrequests')
                                            <a class="nav-link" href="{{url('admin/call')}}">Call Request</a>
                                            @endcan
                                            <!-- <a class="nav-link" href="password.html">Forgot Password</a> -->
                                        </nav>
                                    </div>
                                    <!-- <a class="nav-link" href="{{url('admin/contact')}}">Open Vacancies</a> -->
                                     @can('view openvacancie')
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                    Vacancies
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    @endcan
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="{{url('admin/openvacancie')}}">Open Vacancy</a>

                                            @can('view freshers')
                                            <a class="nav-link" href="{{url('admin/fresher')}}">Fresher</a>
                                            @endcan

                                            @can('view experiences')
                                            <a class="nav-link" href="{{url('admin/experience')}}">Experience</a>
                                            @endcan
                                            <!-- <a class="nav-link" href="404.html">Create Vacancy</a> -->
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <!-- <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a> -->

                            <!-- hiring -->
                             <!-- ishki help se hum sidebar mai options ko show or hide kr skte hai -->
                             <!-- with the help of this can method we can show or hide options on sidebar -->
                             @can('hiring')
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseBlog" aria-expanded="false" aria-controls="collapseBlog">
                                <div class="sb-nav-link-icon"><i class="fas fa-id-users"></i></div>
                                Hiring
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            @endcan
                            <div class="collapse" id="collapseBlog" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                     <!-- blog.index -->
                                    <!-- <a class="nav-link" href="#">All Blogs</a> -->
                                    <!-- blog.create -->

                                     <!-- ishki help se hum sidebar mai options ko show or hide kr skte hai -->
                                     <!-- with the help of this can method we can show or hide options on sidebar -->
                                    @can('create hiring')
                                    <a class="nav-link" href="{{url('admin/hiring')}}">Create Hiring</a>
                                    @endcan


                                    <!-- ishki help se hum sidebar mai options ko show or hide kr skte hai -->
                                     <!-- with the help of this can method we can show or hide options on sidebar -->
                                    @can('view hiring')
                                    <a class="nav-link" href="{{url('admin/hiring/index')}}">Show Hiring</a>
                                    @endcan
                                    <!-- blog.drafts -->
                                    <!-- <a class="nav-link" href="#">Drafts</a> -->
                                </nav>
                            </div>
                            <!-- blog -->

                            @can('blog')
                            <a class="nav-link" href="#">Blogs</a>
                            @endcan
                            <!-- Give Permissions Section -->
                            @can('view user-management')
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePermissions" aria-expanded="false" aria-controls="collapsePermissions">
                                    <div class="sb-nav-link-icon"><i class="fas fa-user-shield"></i></div>
                                       User Management
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                            @endcan
                        <div class="collapse" id="collapsePermissions" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                @can('view role')
                                <a class="nav-link" href="{{url('admin/role/index')}}">Roles</a>
                                @endcan

                                @can('view permission')
                                <a class="nav-link" href="{{url('admin/permissions/index')}}">Permissions</a>
                                @endcan
                                <!-- <a class="nav-link" href="#">Articles</a> -->
                                 @can('view user')
                                <a class="nav-link" href="{{url('admin/user/index')}}">User Section</a>
                                 @endcan
                            </nav>
                        </div>

                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as :  Admin</div>

                    </div>
                </nav>

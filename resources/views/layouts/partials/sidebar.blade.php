<nav class="sb-sidenav accordion bg-light  bg-gradient" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading"></div>
                            <a class="nav-link me-3 ms-3 rounded-md text-white" style="background: linear-gradient(to right, rgb(200, 58, 58) 20%,rgb(40, 6, 6) 80%); border-radius: 10px; height: 40px; " href="{{url('admin/dashboard')}}">
                                <!-- <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div> -->

                                 <img src="/admin/images/admin_logo/dashboard.png" alt="no" style="height: 15px; width: 15px; margin-right: 7px; ">
                                  <div  style="font-size: 13px; transform: 0.3;" onmouseover="this.style.color='black'" onmouseout="this.style.color='white'"> Dashboard</div>

                                  <!-- class="d-flex justify-content-center align-items-center" -->
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
                            <a class="nav-link collapsed text-black "  href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <!-- <div class="sb-nav-link-icon"  ><i class="fas fa-book-open "></i></div> -->
                                 <img src="/admin/images/admin_logo/query.png" style="height:6%; width:10%; margin:7px;" alt="query logo">
                                <div  style="font-size: 15px; transform: 0.3;" onmouseover="this.style.color='red'" onmouseout="this.style.color='black'">Queries </div>
                                <div class="sb-sidenav-collapse-arrow" ><i class="fas fa-angle-down"></i></div>
                            </a>
                            @endcan
                            <div class="collapse " id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">

                                    <a class="nav-link collapsed text-black " href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    @can('contact')
                                  <div style="font-size: 14px; transform: 0.3;" onmouseover="this.style.color='red'" onmouseout="this.style.color='black'"> Contact </div>

                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    @endcan
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                        @can('view contact')
                                            <a class="nav-link text-black" style="font-size:13px;" href="{{url('admin/contacts')}}">Contact Sales</a>
                                        @endcan
                                            @can('view callrequests')
                                            <a class="nav-link text-black" style="font-size:13px;" href="{{url('admin/call')}}">Call Request</a>
                                            @endcan
                                            <!-- <a class="nav-link" href="password.html">Forgot Password</a> -->
                                        </nav>
                                    </div>
                                    <!-- <a class="nav-link" href="{{url('admin/contact')}}">Open Vacancies</a> -->
                                     @can('vacancie')
                                    <a class="nav-link collapsed text-black" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                  <div style="font-size: 14px; transform: 0.3;" onmouseover="this.style.color='red'" onmouseout="this.style.color='black'"> Vacancies </div>
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    @endcan
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                        @can('view openvacancie')
                                            <a class="nav-link text-black" style="font-size:13px;" href="{{url('admin/openvacancie')}}">Open Vacancy</a>
                                            @endcan
                                            @can('view freshers')
                                            <a class="nav-link text-black" style="font-size:13px;" href="{{url('admin/fresher')}}">Fresher</a>
                                            @endcan

                                            @can('view experiences')
                                            <a class="nav-link text-black" style="font-size:14px;" href="{{url('admin/experience')}}">Experience</a>
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
                            <a class="nav-link collapsed text-black"  href="#" data-bs-toggle="collapse" data-bs-target="#collapseBlog" aria-expanded="false" aria-controls="collapseBlog">
                                <!-- <div class="sb-nav-link-icon"><i class="fas fa-id-users"></i></div> -->
                                <img src="/admin/images/admin_logo/hiring.png" style="height:6%; width:10%; margin:7px;" alt="query logo">

                               <div style="font-size: 15px; transform: 0.3;" onmouseover="this.style.color='red'" onmouseout="this.style.color='black'">Hiring </div>
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
                                    <a class="nav-link text-black " style="font-size:14px;" href="{{url('admin/hiring')}}">Create Hiring</a>
                                    @endcan


                                    <!-- ishki help se hum sidebar mai options ko show or hide kr skte hai -->
                                     <!-- with the help of this can method we can show or hide options on sidebar -->
                                    @can('view hiring')
                                    <a class="nav-link text-black" style="font-size:14px;" href="{{url('admin/hiring/index')}}">Show Hiring</a>
                                    @endcan
                                    <!-- blog.drafts -->
                                    <!-- <a class="nav-link" href="#">Drafts</a> -->
                                </nav>
                            </div>
                            <!-- blog -->

                            @can('blog')
                            <a class="nav-link text-black" style="font-size:15px;" href="#">Blogs</a>
                            @endcan
                            <!-- Give Permissions Section -->
                            @can('view user-management')

                                <a class="nav-link collapsed text-black"  href="#" data-bs-toggle="collapse" data-bs-target="#collapsePermissions" aria-expanded="false" aria-controls="collapsePermissions">
                                    <!-- <div class="sb-nav-link-icon"><i class="fas fa-user-shield"></i></div> -->
                                <img src="/admin/images/admin_logo/user.png" style="height:6%; width:10%; margin:7px;" alt="query logo">

                                      <div style="font-size: 15px; transform: 0.3;" onmouseover="this.style.color='red'" onmouseout="this.style.color='black'">User Management</div>
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>

                            @endcan
                        <div class="collapse" id="collapsePermissions" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                @can('view role')
                                <a class="nav-link text-black" style="font-size:13px;" href="{{url('admin/role/index')}}">Roles</a>
                                @endcan

                                @can('view permission')
                                <a class="nav-link text-black "style="font-size:13px;" href="{{url('admin/permissions/index')}}">Permissions</a>
                                @endcan
                                <!-- <a class="nav-link" href="#">Articles</a> -->
                                 @can('view user')
                                <a class="nav-link text-black "style="font-size:13px;" href="{{url('admin/user/index')}}">User Section</a>
                                 @endcan
                            </nav>
                        </div>

                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as : {{DB::table('admins')->where('id', Auth::id())->value('name') }}</div>

                    </div>
                </nav>

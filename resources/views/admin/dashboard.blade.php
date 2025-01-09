@extends('layouts.admin')

@section('content')

<h3 class="mt-4">{{DB::table('admins')->where('id', Auth::id())->value('name') }}</h3>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <!-- contact -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4" style="text-align: center;">
                                    <!-- <img src="/admin/images/admin_logo/contact.png" alt="contact logo is not found " style="height: 70px; width: 70px; display:block; margin-left: 140px;"> -->
                                    <i class="fa-solid fa-address-book fa-2xl" style="color: #ffffff; display:block; margin: 20px auto -4px auto;"></i>
                                    <div class="card-body" style="margin-bottom: -12px;">Contact</div>
                                    <h3>{{DB::table('contacts')->count()}}</h3>
                                    <!-- <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link text-decoration-none" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div> -->
                                </div>
                            </div>
                            <!--Call Request  -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4" style="text-align: center;">
                                <i class="fa-solid fa-phone fa-2xl" style="color: #ffffff; display:block; margin: 20px auto -4px auto;"></i>

                                    <div class="card-body" style="margin-bottom: -12px;">Call Request</div>
                                    <h3>{{DB::table('callrequests')->count()}}</h3>
                                    <!-- <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link text-decoration-none" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div> -->
                                </div>
                            </div>
                            <!-- Trainee -->
                            <div class="col-xl-3 col-md-6" style="text-align: center;">
                                <div class="card bg-success text-white mb-4" >
                                    <img src="/admin/images/admin_logo/fresher2.png" alt="fresher logo is not found " style="height: 45px; width: 45px; display:block; margin: 20px auto -18px auto; ">

                                    <div class="card-body" style="margin-bottom: -12px;">Fresher</div>
                                    <h3>{{DB::table('freshers')->count()}}</h3>
                                    <!-- <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link text-decoration-none" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div> -->
                                </div>
                            </div>
                            <!-- Experience -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4" style="text-align: center; " >
                                <i class="fa-solid fa-trophy fa-2xl" style="color: #ffffff; display:block; margin: 20px auto -4px auto;"></i>
                                    <div class="card-body" style="margin-bottom: -12px;">Experience</div>
                                    <h3 >{{DB::table('experiences')->count()}}</h3>
                                    <!-- <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link text-decoration-none" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div> -->
                                </div>
                            </div>
                            <!--Open-Vacancy -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-secondary text-white mb-4" style="text-align: center;">
                                <i class="fas fa-briefcase fa-solid fa-2xl" style="color: #ffffff; display:block; margin: 20px auto -4px auto;"></i>
                                    <div class="card-body" style="margin-bottom: -12px;">Open-Vacancy</div>
                                    <h3>{{DB::table('open_vacancies')->count()}}</h3>
                                    <!-- <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link text-decoration-none" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
@endsection

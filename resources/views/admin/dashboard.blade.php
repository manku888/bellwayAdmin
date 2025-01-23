@extends('layouts.admin')

@section('content')

<h3 class="mt-4">{{DB::table('admins')->where('id', Auth::id())->value('name') }}</h3>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <!-- contact -->
                             @can('view contact')
                             <div class="col-xl-3 col-md-6 ">
                                <div class="card  text-black mb-5 " style= " text-align: left; height: 50%; position: relative; padding: 10px; background-color: rgb(225, 238, 255);">
                                    <!-- Logo in the top-right corner -->
                                    <!-- <i class="fa-solid fa-phone "
                                        style="color:rgb(101, 90, 226); position: absolute; bottom: 15px; right: 15px; background-color:white"></i> -->
                                        <img src="/admin/images/admin_logo/contact 2.png" alt=""  style="height: 41%; width: 12%; position: absolute; bottom: 15px; right: 15px; object-fit: contain; ">

                                    <!-- Contact text in the top-left corner -->
                                    <div class="card-body" style="margin: 0; padding: 0; font-size: 12px;">
                                        Contact
                                    </div>

                                    <!-- Number below Contact -->
                                    <h3 style="margin: 10px 1 0 0; font-size: 24px;">{{ DB::table('contacts')->count() }}</h3>
                                </div>
                            </div>

                            @endcan
                            <!--Call Request  -->
                             @can('view callrequests')
                            <!-- <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4" style="text-align: center;">
                                <i class="fa-solid fa-phone fa-2xl" style="color: #ffffff; display:block; margin: 20px auto -4px auto;"></i>

                                    <div class="card-body" style="margin-bottom: -12px;">Call Request</div>
                                    <h3>{{DB::table('callrequests')->count()}}</h3> -->
                                    <!-- <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link text-decoration-none" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div> -->
                                <!-- </div>
                            </div> -->

                            <div class="col-xl-3 col-md-6">
                                <div class="card  text-black mb-5" style="text-align: left; height: 50%; position: relative; padding: 5px; background-color: rgb(255, 244, 209);">
                                    <!-- Logo in the top-right corner -->
                                    <!-- <i class="fa-solid fa-phone "
                                        style="color:rgb(101, 90, 226); position: absolute; bottom: 15px; right: 15px; background-color:white"></i> -->
                                        <img src="/admin/images/admin_logo/phone-call.png" alt=""  style="height: 41%; width: 12%; position: absolute; bottom: 15px; right: 15px; object-fit: contain;">

                                    <!-- Contact text in the top-left corner -->
                                    <div class="card-body" style="margin: 0; padding: 0; font-size: 12px;">
                                    Call Request
                                    </div>

                                    <!-- Number below Call Request -->
                                    <h3 style="margin: 10px 1 0 0; font-size: 24px;">{{DB::table('callrequests')->count()}}</h3>
                                </div>
                            </div>
                            @endcan

                            <!-- freshers -->
                            @can('view freshers')
                            <!-- <div class="col-xl-3 col-md-6" style="text-align: center;">
                                <div class="card bg-success text-white mb-4" >
                                    <img src="/admin/images/admin_logo/fresher2.png" alt="fresher logo is not found " style="height: 45px; width: 45px; display:block; margin: 20px auto -18px auto; ">

                                    <div class="card-body" style="margin-bottom: -12px;">Fresher</div>
                                    <h3>{{DB::table('freshers')->count()}}</h3> -->
                                    <!-- <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link text-decoration-none" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div> -->
                                <!-- </div>
                            </div> -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card  text-black mb-5" style="text-align: left; height: 50%; position: relative; padding: 10px; background-color: rgb(216, 248, 233);">
                                    <!-- Logo in the top-right corner -->
                                    <!-- <i class="fa-solid fa-phone "
                                        style="color:rgb(101, 90, 226); position: absolute; bottom: 15px; right: 15px; background-color:white"></i> -->
                                        <img src="/admin/images/admin_logo/graduate-hat.png" alt=""  style="height:50%; width: 15%; position: absolute; bottom: 15px; right: 15px; object-fit: contain;">

                                    <!-- Freshers text in the top-left corner -->
                                    <div class="card-body" style="margin: 0; padding: 0; font-size: 12px;">
                                    Fresher
                                    </div>

                                    <!-- Number below freshers -->
                                    <h3 style="margin: 10px 1 0 0; font-size: 24px;">{{DB::table('freshers')->count()}}</h3>
                                </div>
                            </div>
                            @endcan

                            <!-- Experience -->
                             @can('view experiences')
                            <!-- <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4" style="text-align: center; " >
                                <i class="fa-solid fa-trophy fa-2xl" style="color: #ffffff; display:block; margin: 20px auto -4px auto;"></i>
                                    <div class="card-body" style="margin-bottom: -12px;">Experience</div>
                                    <h3 >{{DB::table('experiences')->count()}}</h3> -->
                                    <!-- <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link text-decoration-none" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div> -->
                                <!-- </div>
                            </div> -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card  text-black mb-5" style="text-align: left; height: 50%; position: relative; padding: 10px; background-color: rgb(220, 215, 249);">
                                    <!-- Logo in the top-right corner -->
                                    <!-- <i class="fa-solid fa-phone "
                                        style="color:rgb(101, 90, 226); position: absolute; bottom: 15px; right: 15px; background-color:white"></i> -->
                                        <img src="/admin/images/admin_logo/certificate.png" alt=""  style="height: 41%; width: 12%; position: absolute; bottom: 15px; right: 15px; object-fit:contain;">

                                    <!-- Experience text in the top-left corner -->
                                    <div class="card-body" style="margin: 0; padding: 0; font-size: 12px;">
                                    Experience
                                    </div>

                                    <!-- Number below experiences -->
                                    <h3 style="margin: 10px 1 0 0; font-size: 24px;">{{DB::table('experiences')->count()}}</h3>
                                </div>
                            </div>

                            @endcan

                            <!--Open-Vacancy -->
                            @can('view openvacancie')
                            <!-- <div class="col-xl-3 col-md-6">
                                <div class="card bg-secondary text-white mb-4" style="text-align: center; ">
                                <i class="fas fa-briefcase fa-solid fa-2xl" style="color: #ffffff; display:block; margin: 20px auto -4px auto;"></i>
                                    <div class="card-body" style="margin-bottom: -12px;">Open-Vacancy</div>
                                    <h3>{{DB::table('open_vacancies')->count()}}</h3> -->
                                    <!-- <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link text-decoration-none" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div> -->
                                <!-- </div>
                            </div> -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card  text-black mb-5" style="text-align: left; height: 50%; position: relative; padding: 10px; background-color: rgb(245, 224, 250);">
                                    <!-- Logo in the top-right corner -->
                                    <!-- <i class="fa-solid fa-phone "
                                        style="color:rgb(101, 90, 226); position: absolute; bottom: 15px; right: 15px; background-color:white"></i> -->
                                        <img src="/admin/images/admin_logo/vacancy.png" alt=""  style="height: 40%; width: 15%; position: absolute; bottom: 15px; right: 15px;object-fit: contain; ">

                                    <!-- open_vacancies text in the top-left corner -->
                                    <div class="card-body" style="margin: 0; padding: 0; font-size: 12px;">
                                    Open-Vacancy
                                    </div>

                                    <!-- Number below open_vacancies -->
                                    <h3 style="margin: 10px 1 0 0; font-size: 24px;">{{DB::table('open_vacancies')->count()}}</h3>
                                </div>
                            </div>


                            @endcan
                        </div>
@endsection

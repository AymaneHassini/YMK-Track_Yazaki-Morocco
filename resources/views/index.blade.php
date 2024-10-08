@extends('admin_dashboard')
@section('admin')

@php
 $date = date('d-F-Y');
 $today_paid = App\Models\Order::where('order_date',$date)->sum('pay');

 $total_paid = App\Models\Order::sum('pay');
 $total_due = App\Models\Order::sum('due'); 

 $completeorder = App\Models\Order::where('order_status','complete')->get(); 

 $pendingorder = App\Models\Order::where('order_status','pending')->get(); 

@endphp

 <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <form class="d-flex align-items-center mb-3">
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control border-0" id="dash-daterange">
                                                <span class="input-group-text bg-blue border-blue text-white">
                                                    <i class="mdi mdi-calendar-range"></i>
                                                </span>
                                            </div>
                                            <a href="javascript: void(0);" class="btn btn-blue btn-sm ms-2">
                                                <i class="mdi mdi-autorenew"></i>
                                            </a>
                                            <a href="javascript: void(0);" class="btn btn-blue btn-sm ms-1">
                                                <i class="mdi mdi-filter-variant"></i>
                                            </a>
                                        </form>
                                    </div>
                                    <h4 class="page-title">Dashboard</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

<div class="row">
<div class="col-md-6 col-xl-3">
    <div class="widget-rounded-circle card">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-lg rounded-circle bg-primary border-primary border shadow">
                        <i class="fe-heart font-22 avatar-title text-white"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-end">
                        <h3 class="text-dark mt-1">$<span data-plugin="counterup">{{ $total_paid }}</span></h3>
                        <p class="text-muted mb-1 text-truncate">Total Paid </p>
                    </div>
                </div>
            </div> <!-- end row-->
        </div>
    </div> <!-- end widget-rounded-circle-->
</div> <!-- end col-->

<div class="col-md-6 col-xl-3">
    <div class="widget-rounded-circle card">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-lg rounded-circle bg-success border-success border shadow">
                        <i class="fe-shopping-cart font-22 avatar-title text-white"></i>
                    </div>
                </div>
                <div class="col-6">
                      <div class="text-end">
                        <h3 class="text-dark mt-1">$<span data-plugin="counterup">{{ $total_due  }}</span></h3>
                        <p class="text-muted mb-1 text-truncate">Total Due </p>
                    </div>
                </div>
            </div> <!-- end row-->
        </div>
    </div> <!-- end widget-rounded-circle-->
</div> <!-- end col-->

<div class="col-md-6 col-xl-3">
    <div class="widget-rounded-circle card">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-lg rounded-circle bg-info border-info border shadow">
                        <i class="fe-bar-chart-line- font-22 avatar-title text-white"></i>
                    </div>
                </div>
                <div class="col-6">
                   <div class="text-end">
                        <h3 class="text-dark mt-1"> <span data-plugin="counterup">{{ count($completeorder)  }}</span></h3>
                        <p class="text-muted mb-1 text-truncate">Complete Order </p>
                    </div>
                </div>
            </div> <!-- end row-->
        </div>
    </div> <!-- end widget-rounded-circle-->
</div> <!-- end col-->

<div class="col-md-6 col-xl-3">
    <div class="widget-rounded-circle card">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-lg rounded-circle bg-warning border-warning border shadow">
                        <i class="fe-eye font-22 avatar-title text-white"></i>
                    </div>
                </div>
                <div class="col-6">
                   <div class="text-end">
                        <h3 class="text-dark mt-1"> <span data-plugin="counterup">{{ count($pendingorder)  }}</span></h3>
                        <p class="text-muted mb-1 text-truncate">Pending Order </p>
                    </div>
                </div>
            </div> <!-- end row-->
        </div>
    </div> <!-- end widget-rounded-circle-->
</div> <!-- end col-->
</div>
                        <!-- end row-->

                        <div class="row">
                                <div class="col-lg-4">
                                    <div class="card bg-pattern">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <img src="backend/assets/images/favicon.ico" alt="logo" class="avatar-xl rounded-circle mb-3">
                                                <h4 class="mb-1 font-20">YMK</h4>
                                                <p class="text-muted font-14">Kenitra, Morocco</p>
                                            </div>

                                            <p class="font-14 text-center text-muted">
                                                Yazaki is a global leader in the development and production of electrical distribution systems, with a major location in Kenitra, Morocco.
                                            </p>

                                            <div class="text-center">
                                            <a href="https://www.kerix.net/fr/annuaire-entreprise/yazaki-kenitra" target="_blank" class="btn btn-sm btn-light">View more info</a>
                                            </div>
                                        </div>
                                    </div> <!-- end card -->
                                </div><!-- end col -->

                                <div class="col-lg-4">
                                    <div class="card bg-pattern">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <img src="backend/assets/images/favicon.ico" alt="logo" class="avatar-xl rounded-circle mb-3">
                                                <h4 class="mb-1 font-20">YMM</h4>
                                                <p class="text-muted font-14">Meknes, Morocco</p>
                                            </div>

                                            <p class="font-14 text-center text-muted">
                                                Yazaki operates another major facility in Meknes, Morocco, specializing in automotive parts manufacturing for global brands.
                                            </p>

                                            <div class="text-center">
                                            <a href="https://www.charika.ma/societe-yazaki-morocco-meknes-413745" target="_blank" class="btn btn-sm btn-light">View more info</a>
                                            </div>

                                          
                                        </div>
                                    </div> <!-- end card -->
                                </div><!-- end col -->

                                <div class="col-lg-4">
                                    <div class="card bg-pattern">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <img src="backend/assets/images/favicon.ico" alt="logo" class="avatar-xl rounded-circle mb-3">
                                                <h4 class="mb-1 font-20">YMT</h4>
                                                <p class="text-muted font-14">Tangier, Morocco</p>
                                            </div>

                                            <p class="font-14 text-center text-muted">
                                                Yazaki’s Tangier facility plays a crucial role in supplying electrical components to automotive industries across Europe and beyond.
                                            </p>

                                            <div class="text-center">
                                            <a href="https://www.kerix.net/fr/annuaire-entreprise/yazaki-tanger" target="_blank" class="btn btn-sm btn-light">View more info</a>
                                            </div>

                                           
                                        </div>
                                    </div> <!-- end card -->
                                </div><!-- end col -->
                        </div>

                        <!-- end row -->

                        <div class="row">
                        <div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="row justify-content-between mb-2">
                <div class="col-auto">
                    <form>
                        <div class="mb-2">
                            <h4>Important Contacts</h4>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-centered table-nowrap table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Title</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Plant</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="table-user">
                                <img src="backend/assets/images/favicon.ico" alt="table-user" class="me-2 rounded-circle">
                                <a href="javascript:void(0);" class="text-body fw-semibold">Aymane Hassini</a>
                            </td>
                            <td>Manager</td>
                            <td>A.hassini@yazaki-europe.com</td>
                            <td>IT</td>
                            <td>YMK</td>

                        </tr>

                        <tr>
                            <td class="table-user">
                                <img src="backend/assets/images/favicon.ico" alt="table-user" class="me-2 rounded-circle">
                                <a href="javascript:void(0);" class="text-body fw-semibold">Mehdi Nejjar</a>
                            </td>
                            <td>Manager</td>
                            <td>Mehdi-n@yazaki-europe.com</td>
                            <td>MGT</td>
                            <td>YMT</td>
                        </tr>

                        <tr>
                            <td class="table-user">
                                <img src="backend/assets/images/favicon.ico" alt="table-user" class="me-2 rounded-circle">
                                <a href="javascript:void(0);" class="text-body fw-semibold">Hiba Bouyahyaoui</a>
                            </td>
                            <td>Manager</td>
                            <td>Hiba-b@yazaki-europe.com</td>
                            <td>HR</td>

                            <td>YMK</td>
                        </tr>

                        <tr>
                            <td class="table-user">
                                <img src="backend/assets/images/favicon.ico" alt="table-user" class="me-2 rounded-circle">
                                <a href="javascript:void(0);" class="text-body fw-semibold">Mamoun Elaraki</a>
                            </td>
                            <td>Supervisor</td>
                            <td>Mam-El@yazaki-europe.com</td>
                            <td>Production</td>
                            <td>YMM</td>

                        </tr>

                        <tr>
                            <td class="table-user">
                                <img src="backend/assets/images/favicon.ico" alt="table-user" class="me-2 rounded-circle">
                                <a href="javascript:void(0);" class="text-body fw-semibold">Achraf Ettouati</a>
                            </td>
                            <td>Senior officer</td>
                            <td>Achraf-ett@yazaki-europe.com</td>
                            <td>Finance</td>

                            <td>YMT</td>
                        </tr>

                        <tr>
                            <td class="table-user">
                                <img src="backend/assets/images/favicon.ico" alt="table-user" class="me-2 rounded-circle">
                                <a href="javascript:void(0);" class="text-body fw-semibold">Fatimazahra El Bouji</a>
                            </td>
                            <td>Manager</td>
                            <td>fatima-z@yazaki-europe.com</td>
                            <td>Quality</td>
                            <td>YMM</td>

                        </tr>

                    </tbody>
                </table>
            </div>
        </div> <!-- end card-body-->
    </div> <!-- end card-->
</div> <!-- end col -->


                            
                        
                    </div> <!-- container -->

                </div> <!-- content -->
@endsection
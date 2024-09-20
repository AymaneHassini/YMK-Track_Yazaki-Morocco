@extends('admin_dashboard')
@section('admin')

 <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                        <a href="{{ route('add.advance.salary') }}" class="btn btn-primary rounded-pill waves-effect waves-light" style="background-color: #e60012; border-color: #e60012; color: white;">
    <i class="mdi mdi-account-circle me-1"></i> Add Advance Salary
</a>                                        </ol>
                                    </div>
                                    <h4 class="page-title">Last Month Salary</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                     
                    
                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Month</th>
                                <th>Salary</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    
        <tbody>
        	@foreach($paidsalary as $key=> $item)
            <tr>
                <td>{{ $key+1 }}</td>
                <td> <img src="{{ asset($item->employee->image) }}" style="width:50px; height: 40px;"> </td>
                <td>{{ $item['employee']['name'] }}</td>
                <td>{{ $item->salary_month }}</td>
                <td>{{ $item['employee']['salary'] }}</td>
                <td><span class="badge" style="background-color: #28a745; color: white; font-size: 1em; padding: 0.5em 1em; border-radius: 0.25em; font-weight: bold; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">Fully Paid</span></td>
                <td>
<a href="{{ route('pay.now.salary',$item->id) }}" class="btn btn-blue rounded-pill waves-effect waves-light">   <i class="fa fa-history" aria-hidden="true"></i> </a> 

                </td>
            </tr>
            @endforeach
        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->
                    </div> <!-- container -->

                </div> <!-- content -->

@endsection 
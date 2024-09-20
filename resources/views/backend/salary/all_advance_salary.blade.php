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
      <a href="{{ route('add.advance.salary') }}"class="btn btn-primary rounded-pill waves-effect waves-light" style="background-color: #e60012; border-color: #e60012; color: white;">Add Advance Salary </a>  
                                        </ol>
                                    </div>
                                    <h4 class="page-title">All Advance Salary</h4>
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
                                <th>Advance</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
        	@foreach($salary as $key=> $item)
            <tr>
                <td>{{ $key+1 }}</td>
                <td> <img src="{{ asset($item->employee->image) }}" style="width:50px;"> </td>
                <td>{{ $item['employee']['name'] }}</td>
                <td>{{ $item->month }}</td>
                <td>{{ $item['employee']['salary'] }}</td>
                <td>

                    @if($item->advance_salary == NULL )
                        <p>No Advance</p>
                    @else
                     {{ $item->advance_salary }}
                    @endif

                  </td>
                <td>
<a href="{{ route('edit.advance.salary',$item->id) }}" class="btn btn-blue rounded-pill waves-effect waves-light" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>  
<a href="{{ route('delete.employee',$item->id) }}"  class="btn btn-danger rounded-pill waves-effect waves-light" id="delete"><i class="fa fa-trash" aria-hidden="true"></i></a>  
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
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
   <button type="button" class="btn btn-primary rounded-pill waves-effect waves-light" style="background-color: #e60012; border-color: #e60012; color: white;" data-bs-toggle="modal" data-bs-target="#signup-modal">Add Category</button> 
                                        </ol>
                                    </div>
                                    <h4 class="page-title">All Category</h4>
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
                                <th>Category Name </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    
    
        <tbody>
        	@foreach($category as $key=> $item)
            <tr>
                <td>{{ $key+1 }}</td> 
                <td>{{ $item->category_name }}</td> 
                <td>
<a href="{{ route('edit.category',$item->id) }}" class="btn btn-blue rounded-pill waves-effect waves-light" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>  
<a href="{{ route('delete.category',$item->id) }}"class="btn btn-danger rounded-pill waves-effect waves-light" id="delete"><i class="fa fa-trash" aria-hidden="true"></i></a>  


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

        <!-- Signup modal content -->
<div id="signup-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body"> 

  <form class="px-3" method="post" action="{{ route('category.store') }}">
                    @csrf

                    <div class="mb-3">
             <label for="username" class="form-label">Category Name</label>
     <input class="form-control" type="text" name="category_name" placeholder="Add Category ">
                    </div>
 

                    <div class="mb-3 text-center">
                        <button  class="btn btn-primary rounded-pill waves-effect waves-light" style="background-color: #1c1c1c; border-color: #1c1c1c; color: white;" type="submit">Save Changes</button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


@endsection 
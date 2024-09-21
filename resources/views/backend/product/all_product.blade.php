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

   <a href="{{ route('import.product') }}"class="btn btn-primary rounded-pill waves-effect waves-light" style="background-color: #28a745; border-color: #28a745; color: white;">Import </a>  
   &nbsp;&nbsp;&nbsp;
   <a href="{{ route('export') }}"class="btn btn-primary rounded-pill waves-effect waves-light" style="background-color: #1c1c1c; border-color: #1c1c1c; color: white;">Export </a>  
   &nbsp;&nbsp;&nbsp;

      <a href="{{ route('add.product') }}"class="btn btn-primary rounded-pill waves-effect waves-light" style="background-color: #e60012; border-color: #e60012; color: white;">Add Product </a>  
                                        </ol>
                                    </div>
                                    <h4 class="page-title">All Product</h4>
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
                                <th>Category</th>
                                <th>Supplier</th>
                                <th>Code</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                 
        <tbody>
        	@foreach($product as $key=> $item)
            <tr>
                <td>{{ $key+1 }}</td>
                <td> <img src="{{ asset($item->product_image) }}" style="width:50px; height: 40px;"> </td>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item['category']['category_name'] }}</td>
                <td>{{ $item['supllier']['name'] }}</td>
                <td>{{ $item->product_code }}</td>
                <td>{{ $item->selling_price }}</td>
                <td>
                    @if($item->expire_date >= Carbon\Carbon::now()->format('Y-m-d'))
                    <span class="badge round-pill bg-success">Valid</span>
                    @else
                    <span class="badge round-pill bg-success">Expired</span>
@endif
                </td>

                <td>
<a href="{{ route('edit.product',$item->id) }}" class="btn btn-blue rounded-pill waves-effect waves-light"><i class="fa fa-pencil" aria-hidden="true"></i></a>
<a href="{{ route('barcode.product',$item->id) }}" class="btn btn-info rounded-pill waves-effect waves-light"><i class="fa fa-barcode" aria-hidden="true"></i></a>
<a href="{{ route('delete.product',$item->id) }}" class="btn btn-danger rounded-pill waves-effect waves-light" id="delete"><i class="fa fa-trash" aria-hidden="true"></i></a>

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
@extends('admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

 <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Admin Profile</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->

<div class="row">
    <div class="col-lg-4 col-xl-4">
        <div class="card text-center">
            <div class="card-body">
                <img id="showImage" src="{{ (!empty($adminData->photo)) ? url('upload/admin_image/'.$adminData->photo) : url('upload/no_image.jpg') }}" class="rounded-circle img-thumbnail" alt="profile-image">
                <h4 class="mb-0">{{ $adminData->name }}</h4>
                <p class="text-muted">{{ $adminData->email }}</p>
                <div class="text-start mt-3">
                    <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ms-2">{{ $adminData->name }}</span></p>
                
                    <p class="text-muted mb-2 font-13"><strong>Phone :</strong><span class="ms-2">{{ $adminData->phone }}</span></p>
                
                    <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ms-2">{{ $adminData->email }}</span></p>
                
                </div>                                    
            </div>                                 
        </div> <!-- end card -->
                            </div> <!-- end col-->

                            <div class="col-lg-8 col-xl-8">
                                <div class="card">
                                    <div class="card-body">
    <!-- end timeline content-->

    <div class="tab-pane" id="settings">
        <form method="post" action="{{ route('admin.profile.store') }}" enctype="multipart/form-data">
        	@csrf

            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Personal Info</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="firstname" class="form-label">First Name</label>
                        <input type="text" name="name" class="form-control" id="firstname" value="{{ $adminData->name }}" >
                        @error('name')
      <span class="text-danger"> {{ $message }} </span>
            @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="lastname"  value="{{ $adminData->email }}" >
                        @error('email')
      <span class="text-danger"> {{ $message }} </span>
            @enderror
                    </div>
                </div> <!-- end col -->

    <div class="col-md-6">
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" id="phone"  value="{{ $adminData->phone }}" >
                        @error('phone')
      <span class="text-danger"> {{ $message }} </span>
            @enderror
                    </div>
                </div> <!-- end col -->

   <div class="col-md-12">
<div class="mb-3">
        <label for="example-fileinput" class="form-label">Admin Profile Image</label>
        <input type="file" name="photo" id="photo" class="form-control">
    </div>
 </div> <!-- end col -->

   <div class="col-md-12">
<div class="mb-3">
        <label for="example-fileinput" class="form-label"> </label>
        <img id="showImage" src="{{ (!empty($adminData->photo)) ? url('upload/admin_image/'.$adminData->photo) : url('upload/no_image.jpg') }}" class="rounded-circle avatar-lg img-thumbnail"
                alt="profile-image">
    </div>
 </div> <!-- end col -->

            </div> <!-- end row -->
 
            <div class="text-end">
                <button type="submit" class="btn btn-primary rounded-pill waves-effect waves-light" style="background-color: #1c1c1c; border-color: #1c1c1c; color: white;"><i class="mdi mdi-content-save"></i> Save</button>
            </div>
        </form>
    </div>
    <!-- end settings content-->
                                    </div>
                                </div> <!-- end card-->

                            </div> <!-- end col -->
                        </div>
                        <!-- end row-->

                    </div> <!-- container -->

                </div> <!-- content -->

<script type="text/javascript">
	
	$(document).ready(function(){
		$('#image').change(function(e){
			var reader = new FileReader();
			reader.onload =  function(e){
				$('#showImage').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});

</script>

@endsection
@extends('admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<style type="text/css">
    .form-check-label {
        text-transform: capitalize;
    }

    /* Checkbox customization: change color to black when checked */
    .form-check-input:checked {
        background-color: #000; /* Set the background color of the checkbox to black */
        border-color: #000; /* Set the border color of the checkbox to black */
    }
</style>

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
                    <h4 class="page-title">Add Role In Permission</h4>
                </div>
            </div>
        </div>     

        <div class="row">
    
            <div class="col-lg-8 col-xl-12">
                <div class="card">
                    <div class="card-body">

                        <div class="tab-pane" id="settings">
                            <form id="myForm" method="post" action="{{ route('role.permission.store') }}" enctype="multipart/form-data">
                                @csrf

                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Add Role In Permission</h5>

                                <div class="row"> 

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">All Roles</label>
                                            <select name="role_id" class="form-select" id="example-select">
                                                <option selected disabled>Select Roles</option>
                                                @foreach($roles as $role)          
                                                    <option value="{{ $role->id }}"> {{ $role->name }}</option> 
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-check mb-2 form-check-primary">
                                        <input class="form-check-input" type="checkbox" value="" id="customckeck15">
                                        <label class="form-check-label" for="customckeck15">Primary</label>
                                    </div>

                                    <hr>

                                    @foreach($permission_groups as $group)
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-check mb-2 form-check-primary">
                                                <!-- Added data-group attribute -->
                                                <input class="form-check-input group-checkbox" type="checkbox" value="" id="customckeck1" data-group="{{ $group->group_name }}">
                                                <label class="form-check-label" for="customckeck1">{{ $group->group_name }}</label>
                                            </div>
                                        </div>

                                        <div class="col-9">
                                            @php
                                            $permissions = App\Models\User::getpermissionByGroupName($group->group_name);
                                            @endphp            

                                            @foreach($permissions as $permission)
                                            <div class="form-check mb-2 form-check-primary">
                                                <!-- Added data-group attribute to link permissions with their group -->
                                                <input class="form-check-input permission-checkbox" type="checkbox" name="permission[]" value="{{ $permission->id }}" id="customckeck{{ $permission->id }}" data-group="{{ $group->group_name }}">
                                                <label class="form-check-label" for="customckeck{{ $permission->id }}">{{ $permission->name }}</label>
                                            </div>
                                            @endforeach
                                            <br>
                                        </div>
                                    </div> <!-- end row -->
                                    @endforeach
                                </div> <!-- end row -->
 
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary rounded-pill waves-effect waves-light" style="background-color: #1c1c1c; border-color: #1c1c1c; color: white;">
                                        <i class="mdi mdi-content-save"></i> Save
                                    </button>
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
    // Handle "Primary" checkbox - select/unselect all checkboxes
    $('#customckeck15').click(function() {
        if ($(this).is(':checked')) {
            $('input[type=checkbox]').prop('checked', true);
        } else {
            $('input[type=checkbox]').prop('checked', false);
        }
    });

    // Handle group checkbox - select/unselect all corresponding permissions
    $('.group-checkbox').click(function() {
        let group = $(this).data('group'); // Get the group name

        // Check or uncheck all corresponding permissions
        if ($(this).is(':checked')) {
            $('.permission-checkbox[data-group="' + group + '"]').prop('checked', true);
        } else {
            $('.permission-checkbox[data-group="' + group + '"]').prop('checked', false);
        }
    });

    // Optional: Check/uncheck the group checkbox based on individual permissions
    $('.permission-checkbox').click(function() {
        let group = $(this).data('group');
        let allChecked = $('.permission-checkbox[data-group="' + group + '"]:not(:checked)').length == 0;
        $('.group-checkbox[data-group="' + group + '"]').prop('checked', allChecked);
    });
</script>

@endsection

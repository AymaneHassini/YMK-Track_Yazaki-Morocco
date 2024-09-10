<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <title>YMK Track</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
        <meta content="Coderthemes" name="author">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">
        <!-- Plugins css -->
        <link href="{{ asset('backend/assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('backend/assets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css">
        <!-- Bootstrap css -->
        <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <!-- App css -->
        <link
            href="{{ asset('backend/assets/css/app.min.css') }}"
            rel="stylesheet"
            type="text/css"
            id="app-style"
        >
        <!-- icons -->
        <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
        <!-- Head js -->
        <script src="{{ asset('backend/assets/js/head.js') }}"></script>
        <style>
        .logo-box {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-box img {
            max-width: 100%;
            max-height: 100%;
            height: auto;
            width: auto;
        }

        .logo-box .logo-sm {
            display: none;
        }

        .logo-box .logo-lg {
            display: block;
        }

        .sidebar-collapsed .logo-box .logo-lg {
            display: none;
        }

        .sidebar-collapsed .logo-box .logo-sm {
            display: block;
        }
    </style>
        <!-- toastr -->

        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

        <!-- toastr -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />



    </head>
    <!-- body start -->
    <body
        data-layout-mode="default"
        data-theme="light"
        data-topbar-color="light"
        data-menu-position="fixed"
        data-leftbar-color="light"
        data-leftbar-size="default"
        data-sidebar-user="false"
    >
        <!-- Begin page -->
        <div id="wrapper">
            <!-- Topbar Start -->
            @include('body.header')

            <!-- end Topbar -->
            <!-- ========== Left Sidebar Start ========== -->
            @include('body.sidebar')

            <!-- Left Sidebar End -->
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <div class="content-page">
               
               @yield('admin')

                <!-- Footer Start -->
                @include('body.footer')
                <!-- end Footer -->

            </div>

            <!-- End Page content -->
            <!-- ============================================================== --></div>
        <!-- END wrapper -->
        <!-- Right Sidebar -->
        @include('body.rightbar')

        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
        <!-- Vendor js -->
        <script src="{{ asset('backend/assets/js/vendor.min.js') }}"></script>
        <!-- Plugins js-->
        <script src="{{ asset('backend/assets/libs/flatpickr/flatpickr.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/selectize/js/standalone/selectize.min.js') }}"></script>
        <!-- Dashboard 1 init js-->
        <script src="{{ asset('backend/assets/js/pages/dashboard-1.init.js') }}"></script>
        <!-- App js-->
        <script src="{{ asset('backend/assets/js/app.min.js') }}"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

      

        <script>
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type','info') }}"
        switch(type){
            case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;

            case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;

            case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;

            case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break; 
        }
        @endif 
        </script>
    </body>
</html>

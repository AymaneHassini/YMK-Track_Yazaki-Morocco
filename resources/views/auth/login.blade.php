<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Login Page | YMK Kenitra</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/yzk.jpg') }}">

    <!-- Bootstrap css -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="{{ asset('backend/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <!-- icons -->
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Head js -->
    <script src="{{ asset('backend/assets/js/head.js') }}"></script>

    <style>
        .btn-primary {
            background-color: #D50000; /* YMK red */
            border-color: #D50000; /* YMK red */
        }
        .btn-primary:hover, .btn-primary:focus, .btn-primary:active {
            background-color: #B40000; /* Darker YMK red for hovering states */
            border-color: #B40000;
        }
        .form-check-input:checked {
            background-color: #D50000; /* YMK red for the checkbox */
            border-color: #D50000;
        }
        .form-check-label {
            color: #000; 
        }
        .authentication-bg {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
    </style>
    
</head>

<body class="authentication-bg authentication-bg-pattern">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <div class="card bg-pattern">
                    <div class="card-body p-4">
                        <div class="text-center w-75 m-auto">
                            <div class="auth-logo">
                                <a href="index.html" class="logo logo-dark text-center">
                                    <span class="logo-lg">
                                        <img src="{{ asset('backend/assets/images/yzk-logo.jpg') }}" alt="" height="22">
                                    </span>
                                </a>

                                <a href="index.html" class="logo logo-light text-center">
                                    <span class="logo-lg">
                                        <img src="{{ asset('backend/assets/images/yzk-logo.jpg') }}" alt="" height="22">
                                    </span>
                                </a>
                            </div>
                        </div>
                        <br>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="login" class="form-label">Email</label>
                                <input class="form-control @error('login') is-invalid @enderror"  name="email" type="text" id="login" required placeholder="Enter your email">
                                @error('login')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" name="password" class="form-control @error('login') is-invalid @enderror" placeholder="Enter your password">
                                    <div class="input-group-text" data-password="false">
                                        <span class="password-eye"></span>
                                    </div>
                                </div>
                                @error('login')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                    <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                </div>
                            </div>

                            <div class="text-center d-grid">
                                <button class="btn btn-primary" type="submit">Log In</button>
                            </div>
                            <div class="text-center mt-3">
                                <p class="text-black-50"><strong>Don't have an account? <a href="{{ route('register') }}" class="text-black" style="font-weight: bold;"><b>Register</b></a></strong></p>
                            </div>
                        </form>
                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->

         
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->

    <footer class="footer footer-alt">
       <script>document.write(new Date().getFullYear())</script> &copy; Yazaki Track - <a href="" class="text-white-50">Yazaki Kenitra</a>
    </footer>

    <script src="{{ asset('backend/assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/app.min.js') }}"></script>

</body>
</html>

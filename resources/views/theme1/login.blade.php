
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>
    <meta charset="utf-8" />
    <title>EZ Solution</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('') }}assets/images/favicon.ico">
    <!-- Layout config Js -->
    <script src="{{ asset('') }}assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('') }}assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('') }}assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('') }}assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('') }}assets/css/custom.min.css" rel="stylesheet" type="text/css" />
</head>
<body>

    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>
            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>
        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="index.html" class="d-inline-block auth-logo">
                                    <img src="{{ asset('') }}assets/images/logo-light.png" alt="" height="20">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">
                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Welcome Back !</h5>
                                    <p class="text-muted">Sign in to continue to EZ Solution.</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <form action="{{ route('login.submit') }}" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
                                        </div>
                                        <div class="mb-3">
                                            <div class="float-end">
                                                <a href="{{ route('forget_password') }}" class="text-muted">Forgot password?</a>
                                            </div>
                                            <label class="form-label" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" class="form-control pe-5 password-input" placeholder="Enter password" id="password-input" name="password">
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                            <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit">Sign In</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                <script>document.write(new Date().getFullYear())</script> EZ Solution.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('') }}assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('') }}assets/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ asset('') }}assets/libs/node-waves/waves.min.js"></script>
    <script src="{{ asset('') }}assets/libs/feather-icons/feather.min.js"></script>
    <script src="{{ asset('') }}assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="{{ asset('') }}assets/js/plugins.js"></script>

    <!-- particles js -->
    <script src="{{ asset('') }}assets/libs/particles.js/particles.js"></script>
    <!-- particles app js -->
    <script src="{{ asset('') }}assets/js/pages/particles.app.js"></script>
    <!-- password-addon init -->
    <script src="{{ asset('') }}assets/js/pages/password-addon.init.js"></script>
    <script>
        function ShowAlert(message,type="success"){
            var color = "linear-gradient(to right, rgb(0 182 160), rgb(0 182 160))";
            if(type=="danger"){
                color = "linear-gradient(to right, rgb(205 70 70), rgb(255 0 0))";
            }
            else if(type=="warning"){
                color = "linear-gradient(to right, rgb(193 133 0), rgb(231 164 51))";
            }
            else if(type=="success"){
                color = "linear-gradient(to right, rgb(80 181 39), rgb(0 183 56))";
            }
            Toastify({
                text: message,
                duration: 3000,
                style: {
                    background: color,
                }
            }).showToast();
        }
        @if ($message = Session::get('_error'))
            ShowAlert('{{ $message }}','danger');
        @elseif  ($message = Session::get('_success'))
            ShowAlert('{{ $message }}','success');
        @endif
    </script>
</body>

</html>
<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Flow Clinic">
    <meta name="author" content="Pongsakorn Laoniyomthai">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/brand/favicon.ico')}}" />

    <!-- TITLE -->
    <title>Flow Clinic – Login</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/dark-style.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/transparent-style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/skin-modes.css')}}" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{asset('assets/colors/color1.css')}}" />

    <!-- P Style --->
    <link href="{{asset('assets/css/pstyle.css')}}" rel="stylesheet" />

</head>

<body class="app sidebar-mini ltr overflow-auto">

    <!-- BACKGROUND-IMAGE -->
    <div class="login-img">

        <!-- GLOABAL LOADER -->
        <div id="global-loader">
            <img src="{{asset('assets/images/loader-ripple.svg')}}" class="loader-img" alt="Loader">
        </div>
        <!-- /GLOABAL LOADER -->

        <!-- PAGE -->
        <div class="page">
            <div class="">

                <!-- CONTAINER OPEN -->
                <div class="col col-login mx-auto">
                    <div class="text-center">
                        <img src="{{asset('assets/images/brand/logo-flowclinic-white-lg.png')}}" class="header-brand-img" alt="" style="height: 150px;">
                    </div>
                </div>

                <div class="container-login100 mb-5">
                    <div class="wrap-login100 p-6">
                        <form class="login100-form validate-form" action="javascript:void(0)" id="loginform" method="POST">
                            <span class="login100-form-title pb-5">
                                Login
                            </span>
                            <div class="panel panel-primary">

                                <div class="panel-body tabs-menu-body p-0">
                                    <div class="wrap-input100 validate-input input-group" data-bs-validate="Valid employee">
                                        <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                            <i class="zmdi zmdi-account text-muted" aria-hidden="true"></i>
                                        </a>
                                        <input class="input100 border-start-0 form-control ms-0" type="text" id="username" name="username" placeholder="รหัสพนักงาน" value="">
                                    </div>
                                    <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                        <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                            <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                        </a>
                                        <input class="input100 border-start-0 form-control ms-0" type="password" id="password" name="password" placeholder="รหัสผ่าน" value="">
                                    </div>
                                    {{-- <div class="text-end pt-4">
                                        <p class="mb-0"><a href="forgot-password.html" class="text-primary ms-1">ลืมรหัสผ่าน?</a></p>
                                    </div> --}}
                                    <div class="container-login100-form-btn mb-2">
                                        <button class="login100-form-btn btn-primary" type="submit" id="btn_loginform"><i class="mdi mdi-key me-2"></i> เข้าสู่ระบบ</button>
                                    </div>
                                    <small id="text-alert" class="text-danger mb-0" style="display: none;"></small>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <!-- CONTAINER CLOSED -->
            </div>
        </div>
        <!-- End PAGE -->

    </div>
    <!-- BACKGROUND-IMAGE CLOSED -->

    <!-- JQUERY JS -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>

    <!-- BOOTSTRAP JS -->
    <script src="{{asset('assets/plugins/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

    <!-- SHOW PASSWORD JS -->
    <script src="{{asset('assets/js/show-password.min.js')}}"></script>

    <!-- GENERATE OTP JS -->
    <script src="{{asset('assets/js/generate-otp.js')}}"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="{{asset('assets/plugins/p-scroll/perfect-scrollbar.js')}}"></script>

    <!-- Color Theme js -->
    <script src="{{asset('assets/js/themeColors.js')}}"></script>

    <!-- CUSTOM JS -->
    <script src="{{asset('assets/js/custom.js')}}"></script>

    <script>
        $('#btn_loginform').click(function(e){
            $('#text-alert').slideUp('fast');
            $('#text-alert').html("");
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({
                url: "{{ route('checklogin') }}",
                method: 'post',
                data: $('#loginform').serialize(),
                success: function(response){

                    if (response.param == true) {
                        location.href = "{{ route('dashboard') }}";
                    }
                    if (response.param == false) {
                        $('#btn_loginform').html('Sign in');
                        $('#text-alert').html('ไม่พบชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง กรุณาตรวจสอบอีกครั้ง');
                        $('#text-alert').slideDown();
                    }
                    if (response.param == "expired") {
                        var u = response.value;
                        location.href = "{{ route('changepassword')}}?username="+u;
                    }
                    if (response.param == "reset") {
                        var u = response.value;
                        location.href = "{{ route('changepassword')}}?username="+u;
                    }
                }
            });
        });
    </script>

</body>

</html>

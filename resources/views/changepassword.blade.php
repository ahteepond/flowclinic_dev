<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Flow Clinic">
    <meta name="author" content="Pongsakorn Laoniyomthai">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/brand/favicon.ico')}}" />

    <!-- TITLE -->
    <title>Flow Clinic – Change Password</title>

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

    <style>
        /* Add a green text color and a checkmark when the requirements are right */
        .valid {
        color: green;
        }

        .valid:before {
        position: relative;
        padding-right: 15px;
        left: 0px;
        content: "✔";
        }

        /* Add a red text color and an "x" when the requirements are wrong */
        .invalid {
        color: red;
        }

        .invalid:before {
        position: relative;
        padding-right: 15px;
        left: 0px;
        content: "✖";
        }
    </style>

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
                        <img src="{{asset('assets/images/brand/logo-flowclinic-white.png')}}" class="header-brand-img" alt="">
                    </div>
                </div>

                <div class="container-login100 mb-5">
                    <div class="wrap-login100 p-6">
                        <form class="login100-form validate-form" action="javascript:void(0)" id="changepasswordform" method="POST">
                            <span class="login100-form-title pb-5">
                                ตั้งรหัสผ่านใหม่
                            </span>
                            <div class="panel panel-primary">

                                <div class="panel-body tabs-menu-body p-0">
                                    <input type="text" id="username" name="username" value="{{ $username }}" style="display: none;" required>
                                    <div class="form-group">
                                        <label for="old_password">เบอร์โทรศัพท์</label>
                                        <input type="text" class="form-control" placeholder="กรอกเบอร์โทรศัพท์" id="tel" name="tel" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="old_password">วันเกิด</label>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                            </div>
                                            <input class="form-control fc-datepicker" name="birthdate" id="birthdate" placeholder="กรอกวันเกิด" type="text" required>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="new_password">รหัสผ่านใหม่</label>
                                        <div class="wrap-input100 validate-input input-group" id="Password-toggle1">
                                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                            </a>
                                            <input class="input100 border-start-0 form-control ms-0" type="password" id="new_password" name="new_password" placeholder="กรอกรหัสผ่านใหม่" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3" id="message" style="display: none;">
                                        <div class="col-12">
                                            <div>
                                                <h5 class="mb-2" style="line-height: 1.2rem;">ตั้งรหัสผ่านตามเงื่อนไขดังนี้ :</h5>
                                                <p id="letter" class="mb-0 invalid">ตัวอักษร <b>อังกฤษพิมพ์เล็ก</b></p>
                                                <p id="capital" class="mb-0 invalid">ตัวอักษร <b>อังกฤษพิมพ์ใหญ่</b></p>
                                                <p id="number" class="mb-0 invalid">ตัวอักษร <b>ตัวเลข</b></p>
                                                <p id="length" class="mb-0 invalid">ตัวอักษรอย่างน้อย <b>8 ตัว</b></p>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="new_password_cfm">ยืนยันรหัสผ่านใหม่</label>
                                        <div class="wrap-input100 validate-input input-group" id="Password-toggle2">
                                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                            </a>
                                            <input class="input100 border-start-0 form-control ms-0" type="password" id="new_password_cfm" name="new_password_cfm" placeholder="กรอกยืนยันรหัสผ่านใหม่" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <small id="text-alert" class="text-danger mb-0 col" style="display: none;"></small>
                                    </div>
                                    <div class="mt-4">
                                        <button type="submit" id="btn_changepasswordform" class="btn btn-primary btn-block btn-primary">ตั้งรหัสผ่าน</button>
                                    </div>
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

    <!-- DATEPICKER JS -->
    <script src="{{asset('assets/plugins/date-picker/date-picker.js')}}"></script>
    <script src="{{asset('assets/plugins/date-picker/jquery-ui.js')}}"></script>
    <script src="{{asset('assets/plugins/input-mask/jquery.maskedinput.js')}}"></script>

    <!-- SELECT2 JS -->
    <script src="{{asset('assets/plugins/select2/select2.full.min.js')}}"></script>

    <!-- INTERNAL Bootstrap-Datepicker js-->
    <script src="{{asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

    <!-- TIMEPICKER JS -->
    <script src="{{asset('assets/plugins/time-picker/jquery.timepicker.js')}}"></script>
    <script src="{{asset('assets/plugins/time-picker/toggles.min.js')}}"></script>

    <!-- SWEET-ALERT JS -->
    <script src="{{asset('assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>

    <!-- GENERATE OTP JS -->
    <script src="{{asset('assets/js/generate-otp.js')}}"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="{{asset('assets/plugins/p-scroll/perfect-scrollbar.js')}}"></script>

    <!-- Color Theme js -->
    <script src="{{asset('assets/js/themeColors.js')}}"></script>

    <!-- CUSTOM JS -->
    <script src="{{asset('assets/js/custom.js')}}"></script>

    <script>
        $( document ).ready(function() {
            // Datepicker
            $('.fc-datepicker').datepicker({
                showOtherMonths: true,
                selectOtherMonths: true,
                dateFormat: 'yy-mm-dd'
                // dateFormat: 'dd-mm-yy'
            });
        });


        var myInput = document.getElementById("new_password");
        var letter = document.getElementById("letter");
        var capital = document.getElementById("capital");
        var number = document.getElementById("number");
        var length = document.getElementById("length");
        myInput.onfocus = function() { $('#message').slideDown(); }
        myInput.onblur = function() { $('#message').slideUp(); }
        let chk_lowerCaseLetters = false;
        let chk_upperCaseLetters = false;
        let chk_numbers = false;
        let chk_length = false;

        myInput.onkeyup = function() {
            // Validate lowercase letters
            var lowerCaseLetters = /[a-z]/g;
            if(myInput.value.match(lowerCaseLetters)) {
                letter.classList.remove("invalid");
                letter.classList.add("valid");
                chk_lowerCaseLetters = true;
            } else {
                letter.classList.remove("valid");
                letter.classList.add("invalid");
                chk_lowerCaseLetters = false;
            }

            // Validate capital letters
            var upperCaseLetters = /[A-Z]/g;
            if(myInput.value.match(upperCaseLetters)) {
                capital.classList.remove("invalid");
                capital.classList.add("valid");
                chk_upperCaseLetters = true;
            } else {
                capital.classList.remove("valid");
                capital.classList.add("invalid");
                chk_upperCaseLetters = false;
            }

            // Validate numbers
            var numbers = /[0-9]/g;
            if(myInput.value.match(numbers)) {
                number.classList.remove("invalid");
                number.classList.add("valid");
                chk_numbers = true;
            } else {
                number.classList.remove("valid");
                number.classList.add("invalid");
                chk_numbers = false;
            }

            // Validate length
            if(myInput.value.length >= 8) {
                length.classList.remove("invalid");
                length.classList.add("valid");
                chk_length = true;
            } else {
                length.classList.remove("valid");
                length.classList.add("invalid");
                chk_length = false;
            }
        }

        $('#btn_changepasswordform').click(function(e){
            if( chk_lowerCaseLetters == false ||
                chk_upperCaseLetters == false ||
                chk_numbers == false ||
                chk_length == false )
            {
                $('#new_password').focus();
                return false;
            }



            $('#text-alert').slideUp('fast');
            $('#text-alert').html("");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{  route('updatepassword') }}",
                method: 'post',
                data: $('#changepasswordform').serialize(),
                success: function(response){
                    if (response.status == 'error') {
                        $('#text-alert').html('ไม่สามารถทำรายการได้');
                        $('#text-alert').slideDown();
                    } else {
                        if (response.param == false) {
                            $('#text-alert').html(response.result);
                            $('#text-alert').slideDown();
                        }
                        if (response.param == true) {
                            swal({
                                title: "ตั้งรหัสผ่านเรียบร้อย!",
                                text: "",
                                type: "success",
                                confirmButtonText: "OK",
                                confirmButtonClass: "btn-success",
                                closeOnConfirm: true,
                            },
                            function(isConfirm) {
                                if (isConfirm) {
                                    location.href = '{{ route('login') }}';
                                }
                            });
                        }
                    }
                }
            });
        });


    </script>

</body>

</html>

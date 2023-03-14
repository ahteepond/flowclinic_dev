<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Flow Clinic">
    <meta name="author" content="Pongsakorn Laoniyomthai">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/brand/favicon.ico')}}" />

    <!-- TITLE -->
    <title>Flow Clinic – @yield('title')</title>

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

<body class="app sidebar-mini ltr light-mode">

    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="{{asset('assets/images/loader-ripple.svg')}}" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">

            <!-- app-Header -->
            <div class="app-header header sticky">
                <div class="container-fluid main-container">
                    <div class="d-flex">
                        <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar" href="javascript:void(0)"></a>
                        <!-- sidebar-toggle-->
                        <a class="logo-horizontal " href="{{ route('index') }}">
                            <img src="{{asset('assets/images/brand/logo-flowclinic-white.png')}}" class="header-brand-img desktop-logo" alt="logo">
                            <img src="{{asset('assets/images/brand/logo-flowclinic-color.png')}}" class="header-brand-img light-logo1"
                                alt="logo">
                        </a>
                        <span class="me-5">( UAT )</span>
                        <!-- LOGO -->
                        <div class="d-flex order-lg-2 ms-auto header-right-icons">
                            <button class="navbar-toggler navresponsive-toggler d-lg-none ms-auto" type="button"
                                data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4"
                                aria-controls="navbarSupportedContent-4" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon fe fe-more-vertical"></span>
                            </button>
                            <div class="navbar navbar-collapse responsive-navbar p-0">
                                <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                                    <div class="d-flex order-lg-2">
                                        <!-- Theme-Layout -->
                                        <div class="dropdown d-flex">
                                            <a class="nav-link icon full-screen-link nav-link-bg">
                                                <i class="fe fe-minimize fullscreen-button"></i>
                                            </a>
                                        </div>
                                        <!-- FULL-SCREEN -->
                                        <div class="dropdown d-flex profile-1">
                                            <a href="javascript:void(0)" data-bs-toggle="dropdown" class="nav-link leading-none d-flex">
                                                <img src="{{ empty(session()->get('session_empimg')) ? asset('assets/images/prv_img.jpg') : session()->get('session_empimg') }}" alt="profile-user"
                                                    class="avatar  profile-user brround cover-image" style="object-fit: cover;">
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                <div class="drop-heading">
                                                    <div class="text-center">
                                                        <h5 class="text-dark mb-0 fs-14 fw-semibold">{{ session()->get('session_fullname') }}</h5>
                                                        <small class="text-muted">{{ session()->get('session_empposition') }}</small>
                                                    </div>
                                                </div>
                                                <div class="dropdown-divider m-0"></div>
                                                <a class="dropdown-item" href="{{ route('user.info') }}">
                                                    <i class="dropdown-icon fe fe-user"></i> ข้อมูลส่วนตัว
                                                </a>
                                                <a class="dropdown-item" href="{{ route('logout') }}">
                                                    <i class="dropdown-icon fe fe-alert-circle"></i> ออกจากระบบ
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /app-Header -->

            <!--APP-SIDEBAR-->
            <div class="sticky">
                <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
                <div class="app-sidebar">
                    <div class="side-header">
                        <a class="header-brand1" href="{{ route('index') }}">
                            <img src="{{asset('assets/images/brand/logo-flowclinic-color.png')}}" class="header-brand-img desktop-logo" alt="logo">
                            <img src="{{asset('assets/images/brand/logo-flowclinic-color-sm.png')}}" class="header-brand-img toggle-logo"
                                alt="logo">
                            <img src="{{asset('assets/images/brand/logo-flowclinic-color-sm.png')}}" class="header-brand-img light-logo" alt="logo">
                            <img src="{{asset('assets/images/brand/logo-flowclinic-color.png')}}" class="header-brand-img light-logo1"
                                alt="logo">
                        </a>
                        <!-- LOGO -->
                    </div>
                    <div class="main-sidemenu">
                        <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg"
                                fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                            </svg></div>
                        <ul class="side-menu">
                            <li class="sub-category">
                                <h3>Main</h3>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="/dashboard"><i
                                        class="side-menu__icon fe fe-home"></i><span
                                        class="side-menu__label">Dashboard</span></a>
                            </li>
                            <li class="sub-category">
                                <h3>Menu</h3>
                            </li>
                            
                            @if ( session()->get('session_role') == 'AD' || session()->get('session_role') == 'SU' )
                                <li class="slide">
                                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                            class="side-menu__icon fe fe-database"></i><span
                                            class="side-menu__label">จัดการข้อมูลพื้นฐาน</span><i
                                            class="angle fe fe-chevron-right"></i></a>
                                    <ul class="slide-menu">
                                        <li><a href="/servicetype" class="slide-item"> ประเภทบริการ</a></li>
                                        <li><a href="/servicemaster" class="slide-item"> บริการหลัก</a></li>
                                        <li><a href="/service" class="slide-item"> รายการบริการ</a></li>
                                        <li><a href="/employee" class="slide-item"> ข้อมูลพนักงาน</a></li>
                                        <li><a href="/paymenttype" class="slide-item"> วิธีการชำระเงิน</a></li>
                                        <li><a href="/discounttype" class="slide-item"> ประเภทส่วนลด</a></li>
                                        <li><a href="/customertype" class="slide-item"> ประเภทลูกค้า</a></li>
                                        <li><a href="/customer" class="slide-item"> รายชื่อลูกค้า</a></li>
                                        {{-- <li><a href="{{ route('index') }}" class="slide-item"> ข้อมูลลูกค้า</a></li> --}}
                                    </ul>
                                </li>
                            @endif
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                        class="side-menu__icon fe fe-slack"></i><span
                                        class="side-menu__label">บันทึกรายการข้อมูล</span><i
                                        class="angle fe fe-chevron-right"></i></a>
                                <ul class="slide-menu">

                                    @if ( session()->get('session_role') == 'S' || session()->get('session_role') == 'AD' || session()->get('session_role') == 'SU' || session()->get('session_role') == 'A' )
                                        <li><a href="/orders" class="slide-item"> จัดการคำสั่งซื้อ</a></li>
                                    @endif


                                    @if ( session()->get('session_role') == 'S' || session()->get('session_role') == 'AD' || session()->get('session_role') == 'SU' )
                                        <li><a href="/orders/new" class="slide-item"> คำสั่งซื้อใหม่</a></li>
                                    @endif
                                    

                                    @if ( session()->get('session_role') == 'A' || session()->get('session_role') == 'AD' || session()->get('session_role') == 'SU' )
                                        <li><a href="/checkpayment" class="slide-item"> ตรวจสอบการชำระเงิน</a></li>
                                    @endif

                                    @if ( session()->get('session_role') == 'S' || session()->get('session_role') == 'AD' || session()->get('session_role') == 'SU' )
                                        <li><a href="/appointment" class="slide-item"> ออกใบนัด</a></li>
                                        <li><a href="/appointment/checklist" class="slide-item"> ตรวจสอบการนัดหมาย</a></li>
                                    @endif

                                    @if ( session()->get('session_role') == 'D' || session()->get('session_role') == 'AD' || session()->get('session_role') == 'SU' )
                                        <li><a href="/appointment/admitted" class="slide-item"> รอรับการรักษา</a></li>
                                    @endif

                                    @if ( session()->get('session_role') == 'O' || session()->get('session_role') == 'AD' || session()->get('session_role') == 'SU' )
                                        <li><a href="/appointment/waittingadmit" class="slide-item"> เข้ารับการรักษา</a></li>
                                    @endif

                                    @if ( session()->get('session_role') == 'D' || session()->get('session_role') == 'S' || session()->get('session_role') == 'AD' || session()->get('session_role') == 'SU' )
                                        <li><a href="/opd" class="slide-item"> ประวัติ OPD</a></li>
                                    @endif

                                    
                                </ul>
                            </li>
                            
                            <li class="sub-category">
                                <h3>Reports</h3>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                        class="side-menu__icon fe fe-file-text"></i><span
                                        class="side-menu__label">รายงาน</span><i
                                        class="angle fe fe-chevron-right"></i></a>
                                <ul class="slide-menu">
                                    <li><a href="/report/customer" class="slide-item"> รายงานข้อมูลลูกค้า</a></li>
                                    <li><a href="/report/individualopd" class="slide-item"> รายงานข้อมูลการรักษารายคน (OPD)</a></li>
                                    <li><a href="/report/productandservice" class="slide-item"> รายงานสินค้าและบริการ</a></li>
                                    <li><a href="/report/dailysalesreceipt" class="slide-item"> รายงานยอดขายรายวัน<br>(ใบเสร็จ)</a></li>
                                    <li><a href="/report/dailysalesproductandservice" class="slide-item"> รายงานยอดขายรายวัน<br>(สินค้าและบริการ)</a></li>
                                </ul>
                            </li>
                        </ul>
                        <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                                width="24" height="24" viewBox="0 0 24 24">
                                <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                            </svg></div>
                    </div>
                </div>
                <!--/APP-SIDEBAR-->
            </div>

            <!--app-content open-->
            <div class="main-content app-content mt-0">
                <div class="side-app">

                    @yield('content')

                </div>
            </div>
            <!--app-content close-->

        </div>


        <!-- FOOTER -->
        <footer class="footer">
            <div class="container">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-md-12 col-sm-12 text-center">
                        Copyright © 2023 <a href="javascript:void(0)">Flow Clinic</a>. All rights reserved.
                    </div>
                </div>
            </div>
        </footer>
        <!-- FOOTER END -->

    </div>

    @yield('other')

    <!-- BACK-TO-TOP -->
    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

    <!-- JQUERY JS -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>

    <!-- BOOTSTRAP JS -->
    <script src="{{asset('assets/plugins/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

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


    <!-- INTERNAL multi js-->
    <script src="{{asset('assets/plugins/multi/multi.min.js')}}"></script>

    <!-- SPARKLINE JS-->
    <script src="{{asset('assets/js/jquery.sparkline.min.js')}}"></script>

    <!-- Sticky js -->
    <script src="{{asset('assets/js/sticky.js')}}"></script>

    <!-- SIDEBAR JS -->
    <script src="{{asset('assets/plugins/sidebar/sidebar.js')}}"></script>

    <!-- INTERNAL Data tables js-->
    <script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap5.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/dataTables.responsive.min.js')}}"></script>

    <!-- FORMELEMENTS JS -->
    {{-- <script src="{{asset('assets/js/formelementadvnced.js')}}"></script> --}}
    <script src="{{asset('assets/js/form-elements.js')}}"></script>

    <!-- SIDE-MENU JS-->
    <script src="{{asset('assets/plugins/sidemenu/sidemenu.js')}}"></script>

    <!-- SWEET-ALERT JS -->
    <script src="{{asset('assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>

    <!-- Color Theme js -->
    <script src="{{asset('assets/js/themeColors.js')}}"></script>

    <!-- CUSTOM JS -->
    <script src="{{asset('assets/js/custom.js')}}"></script>

    <script src="{{asset('assets/js/moment.js')}}"></script>



    <script>
        function commaSeparateNumber(val) {
            // remove sign if negative
            var sign = 1;
            if (val < 0) {
                sign = -1;
                val = -val;
            }

            // trim the number decimal point if it exists
            let num = val.toString().includes('.') ? val.toString().split('.')[0] : val.toString();

            while (/(\d+)(\d{3})/.test(num.toString())) {
                // insert comma to 4th last position to the match number
                num = num.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
            }

            // add number after decimal point
            if (val.toString().includes('.')) {
                num = num + '.' + val.toString().split('.')[1];
            }

            // return result with - sign if negative
            return sign < 0 ? '-' + num : num;
        }
    </script>

    @yield('script')

</body>

</html>

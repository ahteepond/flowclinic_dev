@extends('layouts.template')
@section('title','Dashboard') {{-- Title --}}


@section('content')
    <!-- CONTAINER -->
    <div class="main-container container-fluid">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <h1 class="page-title">Dashboard</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- ROW-1 -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                <div class="row">
                    <h3>My Note</h3>
                    <ul class="list-group">
                        <li class="list-group-item p-5">
                            <h4>เมนู จัดการคำสั่งซื้อ</h4>
                            <p class="m-0">- fillter หน้าจัดการรายการ (Success : order_status) (Error : order_date, order_no)</p>
                            <p class="m-0">- Upload หลักฐานการชำระเงิน (Evidence) (Save/Edit)</p>
                        </li>
                        <li class="list-group-item p-5">
                            <h4>เมนู ออกใบนัด</h4>
                            <p class="m-0">- บันทึกใบนัด (insert ข้อมูล)</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- ROW-1 END -->

    </div>
    <!-- CONTAINER END -->
@endsection


@section('script')
    <script>
    $( document ).ready(function() {
        // alert( "ready!" );
    });



    </script>
@endsection


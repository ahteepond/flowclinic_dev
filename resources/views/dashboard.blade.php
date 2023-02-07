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
                            <h4>เมนู บันทึกรายการข้อมูล > ตรวจสอบการนัดหมาย</h4>
                            <p class="m-0">- [Sale] appointment/checklist แก้ Filter ข้อมูลลูกค้า, เลขที่ใบนัดหมาย, +เลขที่ order</p>
                            <br>
                            <h4>เมนู บันทึกรายการข้อมูล > เข้ารับการรักษา</h4>
                            <p class="m-0">- [Doctor] เพิ่มคอลัมน์ชื่อหมอ (แสดงตอนสถานะ 'รอหมอดำเนินการ')</p>
                            <br>
                            <h4>เมนู จัดการข้อมูลพื้นฐาน</h4>
                            <p class="m-0">- [Superuser] เพิ่มเมนู 'รายการลูกค้า'</p>
                            <br>
                            <h4>แก้ Flow</h4>
                            <p class="m-0">1. Sale -> เลือกหมอ -> ส่งไปให้หมอ</p>
                            <p class="m-0">2. หมอ -> (option : 1. นัดรักษาครั้งต่อไป(จบใบนัด) 2.เข้ารับการรักษา -> ส่งให้ OR)</p>
                            <p class="m-0">3. OR -> เลือก OR -> เข้ารับการรักษาแล้ว(จบใบนัด)</p>
                            <br>
                            <h4>เมนู รายงาน</h4>
                            <p class="m-0">- รายงานข้อมูลลูกค้า</p>
                            <p class="m-0">- รายงานข้อมูลการักษารายคน (OPD)</p>
                            <p class="m-0">- รายงานสินค้าและบริการ</p>
                            <p class="m-0">- รายงานยอดขายรายวัน(ใบเสร็จ)</p>
                            <p class="m-0">- รายงานยอดขายรายวัน(สินค้าและบริการ)</p>
                            <br>
                            <h4>เมนู Dashboard</h4>
                            <p class="m-0">ข้อมูลสรุป</p>
                            <br>
                            <h4>**วิเคราะห์เคสยกเลิก Order</h4>
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


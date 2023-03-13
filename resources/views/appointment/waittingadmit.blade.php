@extends('appointment.list')
@section('title','รอรับการรักษา') {{-- Title --}}

@php $status_param = 3; @endphp

@section('all_list')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            รายการการนัดหมาย
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <table id="datatable" class="table table-bordered w-100 border-bottom">

                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('detail_appointment')
{{-- // disptext_emp --}}
<div class="row mt-6" id="disptext_emp" style="display:none;">
    <div class="col-md-12">
        <p class="h4 fw-semibold">ผู้ดำเนินการรักษา</p>
        <hr class="my-1">
    </div>
    <div class="col-md">
        <p class="fs-14 mb-0"><span class="fw-semibold">หมอ : </span><span class="" id="disp_doc"></span></p>
    </div>
    <div class="col-md">
        <p class="fs-14 mb-0"><span class="fw-semibold">OR คนที่ 1 : </span><span class="" id="disp_or1"></span></p>
        <p class="fs-14 mb-0"><span class="fw-semibold">OR คนที่ 2 : </span><span class="" id="disp_or2"></span></p>
    </div>
</div>

{{-- // disptext_nextapt --}}
<div class="row mt-6" id="disptext_nextapt" style="display:none;">
    <div class="col-md-12">
        <p class="h3 fw-semibold text-primary"><i class="fa fa fa-bell text-warning"></i> นัดรักษาครั้งต่อไป</p>
        <hr class="my-1">
    </div>
</div>

{{-- // disptext_opd --}}
<div class="row mt-6" id="disptext_opd" style="display:none;">
    <div class="col-md-12">
        <p class="h4 fw-semibold">บันทึกประวัติ OPD</p>
        <hr class="my-1">
    </div>
    <div class="col-md-auto" id="btn_viewopd">
        
    </div>
</div>

{{-- // space_emp --}}
<div class="row mt-6" id="space_emp" style="display:none;">
    <div class="col-12"><p class="h4 fw-semibold">เลือกหมอและ OR</p></div>
    <hr class="my-1">
    <div class="col-md-6" id="space_emp_doctor" style="display:none;">
        <div class="form-group">
            <label class="form-label">หมอ :</label>
            <select class="form-control select2-show-search form-select" id="empdoctor" disabled></select>
        </div>
    </div>
    <div class="col-md-6" id="space_emp_or" style="display:none;">
        <div class="form-group">
            <label class="form-label">OR :</label>
            <select class="form-control select2-show-search form-select mb-2" id="empor1"></select>
            <select class="form-control select2-show-search form-select" id="empor2"></select>
        </div>
    </div>
</div>



{{-- // space_nextapt --}}
<div class="row mt-6" id="space_nextapt" style="display:none;">
    <div class="col-12">
        <div class="form-group m-0"> 
            <div class="custom-controls-stacked"> 
                <label class="custom-control custom-checkbox-lg">
                    <input type="checkbox" class="custom-control-input" id="chknextapt" value="1" onclick="changeBtn()">
                    <span class="custom-control-label h4 fw-semibold text-info">นัดรักษาครั้งต่อไป</span> 
                </label>
            </div>
        </div>
    </div>
    <hr class="my-1">
</div>



{{-- // space_opd --}}
<div class="row mt-6" id="space_opd" style="display:none;">
    <div class="col-12"><p class="h4 fw-semibold">OPD</p></div>
    <hr class="my-1">
    <div class="col-md-12">
        <div class="form-group">
            <div class="form-floating floating-label1">
                <textarea class="form-control clear_dtl_i" placeholder="Comments" id="opd" style="height: 140px"></textarea>
                <label for="note"><i class="fa fa-sticky-note-o me-2 text-azure"></i>บันทึก OPD</label>
            </div>
        </div>
    </div>
</div>
@endsection



@section('detail_admitted')
<
@endsection


@section('detail_button')
<button class="btn btn-success my-2 ms-2" onclick="preUpdateAPT(7, 'ยืนยันเข้ารับการรักษาแล้ว')" id="btn_apt_next"  style="display: none;">เข้ารับการรักษาแล้ว</button>
<button class="btn btn-warning my-2 ms-2" onclick="updateAPT(6, 'ยืนยันการส่งบันทึกใบนัดกลับไปให้ Doctor')" id="btn_apt_recall"  style="display: none;">ส่งกลับ</button>
@endsection


@section('js_detail')
<script>
    
    function setShowBtnAndSpace() {
        switch ($('#tmp_status').val()) {
            case '0':
                //Button Display

                //Space Display
                $('#disptext_emp').show();
                $('#disp_note_cancel').show();
            break;
            case '1':
                //Button Display

                //Space Display
                $('#disptext_emp').show();
            break;
            case '2':
                //Button Display

                //Space Display
                $('#disptext_emp').show();
            break;
            case '3':
                //Button Display
                $('#btn_apt_next').show();
                $('#btn_apt_recall').show();
                //Space Display
                $('#space_emp').show();
                $('#space_emp_doctor').show();
                $('#space_emp_or').show();
                $('#space_note').show();
                $('#disptext_opd').show();
            break;
            case '4':
                //Button Display

                //Space Display
                $('#disptext_emp').show();
                $('#disptext_opd').show();
            break;
            case '5':
                //Button Display

                //Space Display
                $('#disptext_emp').show();
                $('#disptext_opd').show();
            break;
            case '6':
                //Button Display
                
                //Space Display
                $('#disptext_emp').show();
            break;
            case '7':
                //Button Display
                
                //Space Display
                $('#disptext_emp').show();
                $('#disptext_opd').show();
            break;
            case '8':
                //Button Display
                
                //Space Display
                $('#disptext_emp').show();
                $('#disptext_opd').show();
            break;
        }
    }

    function preUpdateAPT(status, alert) {
        if (checkEmpSelected() != false) {
            updateAPT(status, alert);
        }
    }

    function checkEmpSelected() {
        if ($('#empdoctor :selected').val() == "") {
            swal({
                title: "กรุณาเลือกหมอ",
                type: "error",
                confirmButtonText: "ตกลง",
            },
            function(isConfirm) {
                 setTimeout(() => { $('#empdoctor :selected').focus(); }, 300)
            });
            return false;
        }
        
        if ($('#empor1 :selected').val() == "") {
            swal({
                title: "กรุณาเลือก OR",
                type: "error",
                confirmButtonText: "ตกลง",
            },
            function(isConfirm) {
                 setTimeout(() => { $('#empor1 :selected').focus(); }, 300)
            });
            return false;
        } else {
            if ($('#empor1 :selected').val() == $('#empor2 :selected').val()) {
                swal({
                    title: "OR ซ้ำ กรุณาตรวจสอบการเลือก OR",
                    type: "error",
                    confirmButtonText: "ตกลง",
                },
                function(isConfirm) {
                    setTimeout(() => { $('#empor2 :selected').focus(); }, 300)
                });
                return false;
            }
        }
    }
    
    
</script>
@endsection



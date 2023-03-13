@extends('appointment.list')
@section('title','ตรวจสอบการนัดหมาย') {{-- Title --}}

@php $status_param = 2; @endphp

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
<style>
    .select2-container { margin-bottom: 10px; }
</style>

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
            <select class="form-control select2-show-search form-select" id="empdoctor"></select>
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


@section('detail_button')
<button class="btn btn-primary my-2 ms-2" onclick="preUpdateAPT(2, 'ยืนยันการบันทึกใบนัด')" id="btn_apt_savedraf" style="display: none;">บันทึก</button>
<button class="btn btn-primary my-2 ms-2" onclick="preUpdateAPT(6, 'ยืนยันการส่งใบนัดให้หมอ')" id="btn_apt_send" style="display: none;">บันทึกและส่งใบนัดให้หมอ</button>
<button class="btn btn-danger my-2 ms-2" onclick="cancelAPT()" id="btn_apt_cancle" style="display: none;">ยกเลิกนัด</button>
@endsection


@section('js_detail')
<script>

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
    }


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
                $('#btn_apt_savedraf').show();
                $('#btn_apt_send').show();
                $('#btn_apt_cancle').show();
                //Space Display
                $('#space_emp').show();
                $('#space_emp_doctor').show();
                $('#space_note').show();
            break;
            case '2':
                //Button Display
                $('#btn_apt_savedraf').show();
                $('#btn_apt_send').show();
                $('#btn_apt_cancle').show();
                //Space Display
                $('#space_emp').show();
                $('#space_emp_doctor').show();
                $('#space_note').show();
            break;
            case '3':
                //Button Display

                //Space Display
                $('#disptext_emp').show();
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

    
</script>
@endsection





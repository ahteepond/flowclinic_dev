@extends('appointment.list')
@section('title','เข้ารับการรักษา') {{-- Title --}}

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


@section('detail_admitted')
<div class="row mt-6" id="space_nextapt">
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
<div class="row mt-6" id="space_opd">
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
<button class="btn btn-info my-2 ms-2" onclick="updateAPT(8, 'ยืนยันนัดรักษาครั้งต่อไป')" id="btn_apt_next">นัดรักษาครั้งต่อไป</button>
<button class="btn btn-success my-2 ms-2" onclick="updateAPT(3, 'ยืนยันเข้ารับการรักษา')" id="btn_apt_send">เข้ารับการรักษาและส่งให้ OR</button>
<button class="btn btn-warning my-2 ms-2" onclick="updateAPT(1, 'ยืนยันการส่งบันทึกใบนัดกลับไปให้ Sale')" id="btn_apt_recall">ส่งกลับ</button>
@endsection

@section('js_detail')
<script>
    $( document ).ready(function() {
        
    });

    $("#dtlapt_modal").on('show.bs.modal', function(){
        setTimeout(() => { 
            if ($('#tmp_status').val() == 1) {
                $('#btn_apt_send').hide();
                $('#btn_apt_cancle').hide();
                $('#space_note').hide();
                $('#space_nextapt').hide();
                $('#space_opd').hide();
                $('#space_note').hide();
            }
            if ($('#tmp_status').val() == 2) {
                $('#btn_apt_send').hide();
                $('#btn_apt_cancle').hide();
                $('#space_note').hide();
                $('#space_nextapt').hide();
                $('#space_opd').hide();
                $('#space_note').hide();
            }
            if ($('#tmp_status').val() == 3) {
                $('#btn_apt_send').hide();
                $('#btn_apt_recall').hide();
                $('#btn_apt_cancle').hide();
                $('#btn_apt_next').hide();
                $('#space_note').hide();
                $('#space_nextapt').hide();
                $('#space_opd').hide();
                $('#space_note').hide();
            }
            if ($('#tmp_status').val() == 6) {
                $('#space_emp').hide();
                $('#disptext_emp').show();
                changeBtn();
            }
            if ($('#tmp_status').val() == 7) {
                $('#space_emp').hide();
                $('#disptext_emp').show();
                $('#btn_apt_next').hide();
                $('#btn_apt_send').hide();
            }
            if ($('#tmp_status').val() == 8) {
                $('#space_emp').hide();
                $('#disptext_emp').show();
                $('#btn_apt_next').hide();
                $('#btn_apt_send').hide();
                $('#space_nextapt').hide();
            }
        }, 150)
    });

    function changeBtn() {
        if($("#chknextapt").prop("checked")) {
            console.log('t');
            $('#btn_apt_next').show();
            $('#btn_apt_send').hide();
        } else {
            console.log('f');
            $('#btn_apt_next').hide();
            $('#btn_apt_send').show();
        }  
    }

</script>
@endsection





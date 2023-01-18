<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class AppointmentController extends Controller
{

    public function __construct() {
        $this->middleware('checksession');
    }

    public function index() {
        return view('appointment.index');
    }

    public function new($id) {
        $info = DB::table('orders_detail as od')
        ->join('orders as o', 'od.order_code', '=', 'o.code')
        ->join('customer as c', 'o.cust_code', '=', 'c.code')
        ->join('service as s', 'od.service_code', '=', 's.code')
        ->join('service_master as sm', 's.servicemaster_id', '=', 'sm.id')
        ->join('service_type as st', 'sm.servicetype_id', '=', 'st.id')
        ->select(
            'c.code as cust_code',
            'c.fname as cust_fname',
            'c.lname as cust_lname',
            'c.tel as cust_tel',
            'c.addr as cust_addr',
            'c.idcard as cust_idcard',
            'c.bdate as cust_bdate',
            'c.bloodtype as cust_bloodtype',
            'st.name_th as servicetype_nameth',
            'st.name_en as servicetype_nameen',
            'sm.name_th as servicemaster_nameth',
            'sm.name_en as servicemaster_nameen',
            's.name_th as service_nameth',
            's.name_en as service_nameen',
            'od.*'
        )
        ->where('od.id', $id)
        ->first();

        $findround = DB::table('appointment')
        ->select('round_at')
        ->where('orderdetail_id', $id)
        ->orderBy('round_at', 'desc')
        ->first();

        if ($findround == null) {
            $round = 0;
        } else {
            $round = $findround->round_at;
        }
        return view('appointment.new', compact('info', 'round'));
    }

    public function history() {
        return view('appointment.history');
    }

    public function searchorders(Request $request) {
        $customer = DB::table('customer')
        ->where($request->filtertype, $request->filtertext)
        ->get();
        if ($customer->isEmpty()) {
            return response()->json([ 'status' => 'failed', 'result' => false ]);
        } else {
            return response()->json([ 'status' => 'success', 'result' => true, 'customer' => $customer[0] ]);
        }
    }

    public function orderlist(Request $request) {
        if ($request->ajax()) {
            $data = DB::table('orders as o')
            ->where('o.cust_code', $request->customercode)
            ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('orderscode', function($row){
                    return $row->code;
                })
                ->addColumn('ordersdate', function($row){
                    return $row->orderdate;
                })
                ->addColumn('selectservice', function($row){
                    return '<a class="btn btn-sm btn-primary" data-bs-effect="effect-scale" data-bs-toggle="modal" href="#modal_servicelist" onclick="serviceList('."'".$row->code."'".')">เลือกบริการ</a>';
                })
                ->rawColumns(['orderscode','selectservice'])
                ->make(true);
        }
    }

    public function servicelist(Request $request) {
        if ($request->ajax()) {
            $data = DB::table('orders_detail as od')
            ->join('service as s', 'od.service_code', '=', 's.code')
            ->join('service_master as sm', 's.servicemaster_id', '=', 'sm.id')
            ->join('service_type as st', 'sm.servicetype_id', '=', 'st.id')
            ->select(
                'od.id', 'od.order_code', 'od.service_code', 'od.qty_service', 'od.price_total_service',
                'st.name_th as servicetype_nameth',
                'sm.name_th as servicemaster_nameth',
                'sm.name_en as servicemaster_nameen',
                's.name_th as service_nameth',
                's.name_en as service_nameen',
                's.description'
            )
            ->where('od.order_code', $request->ordercode)
            ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('servicecode', function($row){
                    return $row->service_code;
                })
                ->addColumn('service', function($row){
                    return $row->service_nameth;
                })
                ->addColumn('servicemaster', function($row){
                    return $row->servicemaster_nameth;
                })
                ->addColumn('servicetype', function($row){
                    return $row->servicetype_nameth;
                })
                ->addColumn('qty', function($row){
                    return $row->qty_service;
                })
                ->addColumn('selectservice', function($row){
                    return '<a class="btn btn-sm btn-primary" data-bs-effect="effect-scale" data-bs-toggle="modal" href="#modal_servicelist" onclick="takeAppointment('."'".$row->order_code."'".","."'".$row->service_code."'".","."'".$row->id."'".')">ทำใบนัด</a>';
                })
                ->rawColumns(['orderscode','selectservice'])
                ->make(true);
        }
    }

    public function insert(Request $request) {
        //Set Status for Action
        $status_param = 2; //บันทึก(S)

        //Check Running Order No
        $rescode = DB::table('appointment')
            ->orderBy('code', 'DESC')
            ->first();
        $prefix = "APT".Carbon::now()->format('ym')."-";
        if ($rescode) {
            if (Carbon::parse($rescode->created_at)->format('Y-m') != Carbon::now()->format('Y-m')) {
                $gencode = $prefix . "00001";
            } else {
                $code_current = explode('-',$rescode->code)[1];
                $code_new = sprintf("%05d", (int)$code_current + 1);
                $gencode = $prefix . $code_new;
            }
        } else {
            $gencode = $prefix . "00001";
        }

        $res_aptstatus = DB::table('appointment_status')
        ->where('status', $status_param)
        ->first();

        $arr_data = array(
            'code' => $gencode,
            'orderdetail_id' => $request->orderdetail_id,
            'order_code' => $request->order_code,
            'service_name' => $request->service_name,
            'servicemaster_name' => $request->servicemaster_name,
            'servicetype_name' => $request->servicetype_name,
            'cust_code' => $request->cust_code,
            'round_at' => $request->round_at,
            'appointment_date' => Carbon::parse($request->appointment_date)->format('Y-m-d'),
            'appointment_time' => Carbon::parse($request->appointment_time)->format('H:i:s'),
            'status' => $res_aptstatus->status,
            'creator' => $request->creator,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        );
        DB::table('appointment')->insertOrIgnore($arr_data);

        $arr_note = array(
            'appointment_code' => $gencode,
            'emp_session' => $request->creator,
            'status' => $res_aptstatus->status,
            'status_text' => $res_aptstatus->status_text,
            'note' => $request->note,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        );
        DB::table('appointment_note')->insertOrIgnore($arr_note);

        return response()->json([ 'status' => 'success', 'result' => true ]);
    }


    public function checklist() {
        $session_cur = session()->get('session_empcode');
        $empdtl = DB::table('employee')
        ->where('emp_code',$session_cur)
        ->first();

        $aptstatus = DB::table('appointment_status')
        // ->where('role','like','%|'.$empdtl->emp_prefix.'|%')
        ->get();

        return view('appointment.checklist', compact('aptstatus'));
    }
    
    public function waittingadmit() {
        $session_cur = session()->get('session_empcode');
        $empdtl = DB::table('employee')
        ->where('emp_code',$session_cur)
        ->first();

        $aptstatus = DB::table('appointment_status')
        // ->where('role','like','%|'.$empdtl->emp_prefix.'|%')
        ->get();

        return view('appointment.waittingadmit', compact('aptstatus'));
    }

    public function admitted() {
        $session_cur = session()->get('session_empcode');
        $empdtl = DB::table('employee')
        ->where('emp_code',$session_cur)
        ->first();

        $aptstatus = DB::table('appointment_status')
        // ->where('role','like','%|'.$empdtl->emp_prefix.'|%')
        ->get();

        return view('appointment.admitted', compact('aptstatus'));
    }

    public function getemplist(Request $request) {
        $res = DB::table('employee')
        ->where('emp_prefix', $request->prefix)
        ->where('active', 1)
        ->get();
        return response()->json([ 'status' => 'success', 'result' => true, 'data' => $res,]);
    }

    public function getaptlist(Request $request) {
        if ($request->ajax()) {
            $data = DB::table('appointment as a');
            $data = $data->join('customer as c', 'c.code', '=', 'a.cust_code');
            $data = $data->select(
                'c.fname as custfname',
                'c.lname as custlname',
                'c.idcard',
                'c.tel',
                'a.*'
            );
            if($request->cust_value != '') { $data = $data->where($request->cust_option, $request->cust_value); }
            if($request->code != '') { $data = $data->where('a.code', $request->code); }
            if($request->date != '') { $data = $data->where('a.appointment_date', $request->date); }
            if($request->status != '') { $data = $data->where('a.status', $request->status); }
            $data = $data->orderBy('a.code', 'desc');
            $data = $data->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aptcode', function($row){
                    return '<a href="javascript:void(0)" data-bs-effect="effect-scale" onclick="detail('."'".$row->code."'".')" title="" class="text-primary modal-effect">'.$row->code.'</a>';
                })
                ->addColumn('custfullname', function($row){
                    return $row->custfname.' '.$row->custlname;
                })
                ->addColumn('aptstatus', function($row){
                    $status = $row->status;
                    if ($status == 0) { $res_o = '<span class="badge bg-danger-transparent rounded-pill text-danger p-2 px-3">ยกเลิก</span>'; }
                    if ($status == 1) { $res_o = '<span class="badge bg-info-transparent rounded-pill text-info p-2 px-3">รอการแก้ไข (S)</span>'; }
                    if ($status == 2) { $res_o = '<span class="badge bg-primary-transparent rounded-pill text-primary p-2 px-3">บันทึก (S)</span>'; }
                    if ($status == 3) { $res_o = '<span class="badge bg-warning-transparent rounded-pill text-warning p-2 px-3">รอ OR ดำเนินการ</span>'; }
                    if ($status == 4) { $res_o = '<span class="badge bg-info-transparent rounded-pill text-info p-2 px-3">รอการแก้ไข (O)</span>'; }
                    if ($status == 5) { $res_o = '<span class="badge bg-primary-transparent rounded-pill text-primary p-2 px-3">บันทึก (O)</span>'; }
                    if ($status == 6) { $res_o = '<span class="badge bg-warning-transparent rounded-pill text-warning p-2 px-3">รอหมอดำเนินการ</span>'; }
                    if ($status == 7) { $res_o = '<span class="badge bg-success-transparent rounded-pill text-success p-2 px-3">เข้ารับการรักษาแล้ว</span>'; }
                    if ($status == 90) { $res_o = '<span class="badge bg-success-transparent rounded-pill text-primary p-2 px-3">นัดรักษาครั้งต่อไป</span>'; }
                    return $res_o;
                })
                ->addColumn('aptnextflag', function($row){
                    $res_nextflag = $row->nextapt_flag;
                    return $res_nextflag == 1 ? '<i class="fa fa fa-bell text-warning"></i>' : '-';
                })
                ->addColumn('aptdatetime', function($row){
                    $datetime = $row->appointment_date.'<br>'.$row->appointment_time;
                    return $datetime;
                })
                ->addColumn('created', function($row){
                    $created = $row->created_at;
                    return $created;
                })
                ->rawColumns(['aptcode', 'aptstatus', 'aptnextflag', 'aptdatetime', 'action'])
                ->make(true);
        }
    }



    public function getaptdetail(Request $request) {
        $res = DB::table('appointment as a')
        ->join('customer as c', 'a.cust_code', '=', 'c.code')
        ->select(
            'a.*',
            'c.fname', 
            'c.lname',
            'c.tel',
            'c.addr',
            'c.idcard',
            'c.bdate',
            'c.bloodtype'
        )
        ->where('a.code', $request->aptcode)
        ->first();
        $note = DB::table('appointment_note as an')
        ->select(
            'an.*',
            'e.emp_fname_th', 
            'e.emp_lname_th',
            'ep.emp_posi_name',
        )
        ->join('employee as e', 'an.emp_session', '=', 'e.emp_code')
        ->join('employee_position as ep', 'e.emp_prefix', '=', 'ep.prefix')
        ->where('an.appointment_code', $request->aptcode)
        ->orderBy('created_at', 'asc')
        ->get();

        $empdoc = DB::table('appointment as a')
        ->join('employee as e', 'a.doctor', '=', 'e.emp_code')
        ->select( 'e.*' )
        ->where('a.code', $request->aptcode)
        ->first();
        $empor1 = DB::table('appointment as a')
        ->join('employee as e', 'a.or_1', '=', 'e.emp_code')
        ->select( 'e.*' )
        ->where('a.code', $request->aptcode)
        ->first();
        $empor2 = DB::table('appointment as a')
        ->join('employee as e', 'a.or_2', '=', 'e.emp_code')
        ->select( 'e.*' )
        ->where('a.code', $request->aptcode)
        ->first();

        return response()->json([ 'status' => 'success', 'result' => true, 'param' => $res, 'note' => $note, 'empdoc' => $empdoc, 'empor1' => $empor1, 'empor2' => $empor2, ]);
    }


    public function updateaptdetail(Request $request) {
        $reqstatus = $request->param;
        $reqnote = $request->note;
        $reqcancel = $request->note_cancel;

        $reqdoctor = $request->doctor ? $request->doctor : null;
        $reqor1 = $request->or_1 ? $request->or_1 : null;
        $reqor2 = $request->or_2 ? $request->or_2 : null;

        $reqchknextapt = $request->chknextapt;
        $reqopd = $request->opd;

        switch ($reqstatus) {
            case 0:
                $arr_apt = array(
                    'note_cancel' => $reqcancel,
                    'status' => $reqstatus,
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                );
                break;
            case 3:
                //Update Appointment
                $arr_apt = array(
                    'note_cancel' => $reqcancel,
                    'status' => $reqstatus,
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                );
                
                break;
            case 5:
                //Update Appointment
                $arr_apt = array(
                    'status' => $reqstatus,
                    'doctor' => $reqdoctor,
                    'or_1' => $reqor1,
                    'or_2' => $reqor2,
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                );
                break;
            case 6:
                //Update Appointment
                $arr_apt = array(
                    'status' => $reqstatus,
                    'doctor' => $reqdoctor,
                    'or_1' => $reqor1,
                    'or_2' => $reqor2,
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                );
                break;
            case 7:
                //Update Appointment
                $arr_apt = array(
                    'status' => $reqstatus,
                    'nextapt_flag' => $reqchknextapt,
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                );
                //Add OPD
                $ordercode = DB::table('appointment')
                ->where('code', $request->aptcode)
                ->first();
                $arr_opd = array(
                    'appointment_code' => $request->aptcode,
                    'order_code' => $ordercode->order_code,
                    'emp_session' => session()->get('session_empcode'),
                    'note' => $reqopd,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                );
                DB::table('opd')->insertOrIgnore($arr_opd);
                break;
            default:
                //Update Appointment
                $arr_apt = array(
                    'status' => $reqstatus,
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                );
                break;
        }

        
        $res = DB::table('appointment')
        ->where('code', $request->aptcode)
        ->update($arr_apt);

        //Add Note
        $notestatus = DB::table('appointment_status')
        ->where('status', $reqstatus)
        ->first();
        $arr_note = array(
            'appointment_code' => $request->aptcode,
            'emp_session' => session()->get('session_empcode'),
            'status' => $reqstatus,
            'status_text' => $notestatus->status_text,
            'note' => $reqnote,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        );
        DB::table('appointment_note')->insertOrIgnore($arr_note);
        
        return response()->json([ 'status' => 'success', 'result' => true, 'param' => $res, 'aptcode' => $request->aptcode ]);
    }





}

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

        //Check Running Order No
        $rescode = DB::table('appointment')
            ->orderBy('code', 'DESC')
            ->first();
        $prefix = "APT".Carbon::now()->format('ym')."-";
        if ($rescode) {
            if (Carbon::parse($rescode->created_at)->format('Y-m-d') != Carbon::now()->format('Y-m-d')) {
                $gencode = $prefix . "00001";
            } else {
                $code_current = explode('-',$rescode->code)[1];
                $code_new = sprintf("%05d", (int)$code_current + 1);
                $gencode = $prefix . $code_new;
            }
        } else {
            $gencode = $prefix . "00001";
        }

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
            'note_sale' => $request->note_sale,
            'status' => 1,
            'creator' => $request->creator,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        );
        $res = DB::table('appointment')
        ->insertOrIgnore($arr_data);
        return response()->json([ 'status' => 'success', 'result' => true, 'param' => $res ]);
    }


    public function checklist() {
        return view('appointment.checklist');
    }

    public function getlist(Request $request) {
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
            $data = $data->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aptcode', function($row){
                    return '<a href="javascript:void(0)" onclick="detail('."'".$row->code."'".')" title="" class="text-primary">'.$row->code.'</a>';
                })
                ->addColumn('custfullname', function($row){
                    return $row->custfname.' '.$row->custlname;
                })
                ->addColumn('aptstatus', function($row){
                    $status = $row->status;
                    if ($status == 0) { $res_o = '<span class="badge bg-danger-transparent rounded-pill text-danger p-2 px-3">ยกเลิก</span>'; }
                    if ($status == 1) { $res_o = '<span class="badge bg-primary-transparent rounded-pill text-primary p-2 px-3">บันทึก</span>'; }
                    if ($status == 2) { $res_o = '<span class="badge bg-info-transparent rounded-pill text-info p-2 px-3">รอ OR ดำเนินการ</span>'; }
                    if ($status == 3) { $res_o = '<span class="badge bg-warning-transparent rounded-pill text-warning p-2 px-3">รอหมอดำเนินการ</span>'; }
                    if ($status == 4) { $res_o = '<span class="badge bg-success-transparent rounded-pill text-success p-2 px-3">เข้ารับการรักษาแล้ว</span>'; }
                    return $res_o;
                })
                ->addColumn('aptdatetime', function($row){
                    $datetime = $row->appointment_date.'<br>'.$row->appointment_time;
                    return $datetime;
                })
                ->addColumn('created', function($row){
                    $created = $row->created_at;
                    return $created;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" title="ส่ง OR" onclick="sendtoOR('."'".$row->code."'".')" class="btn btn-sm btn-outline-primary mb-2 ms-2">ส่ง OR</a>';
                    $btn .= '<a href="javascript:void(0)" title="ยกเลิกนัด" onclick="cancleAPT('."'".$row->code."'".')" class="btn btn-sm btn-outline-danger mb-2 ms-2">ยกเลิกนัด</a>';
                    return $btn;
                })
                ->rawColumns(['aptcode', 'aptstatus', 'aptdatetime', 'action'])
                ->make(true);
        }
    }





}

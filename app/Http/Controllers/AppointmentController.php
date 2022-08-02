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

}

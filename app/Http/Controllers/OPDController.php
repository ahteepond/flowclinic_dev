<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class OPDController extends Controller
{

    public function __construct() {
        $this->middleware('checksession');
    }
    
    public function index() {
        return view('opd.index');
    }


    public function detail($customercode) {
        $custcode = DB::table('customer')
            ->where('code', $customercode)
            ->first();

        $opddtl = DB::table('opd as op')
        ->join('appointment as ap', 'ap.code', '=', 'op.appointment_code')
        ->select(DB::raw(
            'op.*, 
            ap.service_name,
            ap.servicemaster_name,
            ap.servicetype_name,
            ap.round_at,
            ap.appointment_date,
            ap.appointment_time,
            ap.nextapt_flag,
            ap.doctor as doctor_code,
            ap.or_1 as or1_code,
            ap.or_2 as or2_code,
            (SELECT CONCAT(emp_fname_th, " ", emp_lname_th) FROM employee e WHERE e.emp_code = ap.doctor) AS doctor_name, 
            (SELECT CONCAT(emp_fname_th, " ", emp_lname_th) FROM employee e WHERE e.emp_code = ap.or_1) AS or1_name,
            (SELECT CONCAT(emp_fname_th, " ", emp_lname_th) FROM employee e WHERE e.emp_code = ap.or_2) AS or2_name'
        ))
        ->where('ap.cust_code', $customercode)
        ->orderBy('op.created_at', 'ASC')
        ->get();

        return view('opd.detail', compact('custcode', 'opddtl') );
    }

    public function search(Request $request) {
        $customer = DB::table('customer')
        ->where($request->filtertype, $request->filtertext)
        ->get();

        if ($customer->isEmpty()) {
            return response()->json([ 'status' => 'failed', 'result' => false ]);
        } else {
            return response()->json([ 'status' => 'success', 'result' => true, 'customer' => $customer[0] ]);
        }
    }


    public function list(Request $request) {
        if ($request->ajax()) {
            $data = DB::table('opd')
            ->join('appointment', 'appointment.code', '=', 'opd.appointment_code')
            ->join('customer', 'customer.code', '=', 'appointment.cust_code')
            // ->join('employee', 'employee.emp_code', '=', 'opd.emp_session')
            ->select(
                'opd.*', 
                'appointment.service_name',
                'appointment.servicemaster_name',
                'appointment.servicetype_name',
                'appointment.round_at',
                'appointment.cust_code',
                'customer.fname',
                'customer.lname',
                // 'employee.emp_fname_th as doctor_fname',
                // 'employee.emp_lname_th as doctor_lname'
            )
            ->where('appointment.cust_code', $request->customercode)
            ->orderBy('opd.created_at', 'ASC')
            ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('created', function($row){
                    return $row->created_at;
                })
                ->addColumn('orderscode', function($row){
                    return $row->order_code;
                })
                ->addColumn('aptcode', function($row){
                    return $row->appointment_code;
                })
                ->addColumn('custcode', function($row){
                    return $row->cust_code;
                })
                ->addColumn('custname', function($row){
                    return $row->fname. ' ' .$row->lname ;
                })
                ->addColumn('service_name', function($row){
                    return $row->service_name;
                })
                ->addColumn('servicemaster_name', function($row){
                    return $row->servicemaster_name;
                })
                ->addColumn('servicetype_name', function($row){
                    return $row->servicetype_name;
                })
                ->addColumn('round_at', function($row){
                    return $row->round_at;
                })
                ->addColumn('note', function($row){
                    return $row->note;
                })
                // ->addColumn('doctor', function($row){
                //     return $row->doctor_fname. ' ' .$row->doctor_lname ;
                // })
                ->rawColumns(['aptcode'])
                ->make(true);
        }
    }
}

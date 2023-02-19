<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function __construct() {
        $this->middleware('checksession');
    }

    public function index() {
        $customer_type = DB::table('customer_type')
        ->where('active', 1)
        ->get();
        return view('customer.index', compact('customer_type'));
    }

    public function list(Request $request) {
        if ($request->ajax()) {
            $data = DB::table('customer');
            $data = $data->join('customer_type', 'customer_type.id', '=', 'customer.customertype_id');
            $data = $data->select(
                'customer_type.name as customertype_name',
                'customer.*');
            $data = $data->where('customer.active', $request->active);
            if ($request->customertype != 'A') {
                $data = $data->where('customer.customertype_id', $request->customertype);
            }
            $data = $data->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('custcode', function($row){
                    return $row->code;
                })
                 ->addColumn('custtype', function($row){
                    return $row->customertype_name;
                })
                ->addColumn('custname', function($row){
                    return $row->fname.' '. $row->lname;
                })
                ->addColumn('custtel', function($row){
                    return $row->tel;
                })
                ->addColumn('active', function($row){
                    $int_active = $row->active;
                    if ($int_active == 0) { $active = '<span class="badge bg-danger-transparent rounded-pill text-danger p-2 px-3">Inactive</span>'; }
                    if ($int_active == 1) { $active = '<span class="badge bg-success-transparent rounded-pill text-success p-2 px-3">Active</span>'; }
                    return $active;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" title="แก้ไข" onclick="edit('.$row->id.')" class="btn text-primary btn-sm"><span class="fe fe-edit"></span></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'active'])
                ->make(true);
        }
    }

    public function new() {
        return view('customer.new');
    }

    public function insert(Request $request) {
        $chkdata_name = DB::table('customer')
        ->where('fname', $request->n_fname)
        ->where('lname', $request->n_lname)
        ->get();
        if (!$chkdata_name->isEmpty()) {
            return response()->json([ 'status' => 'failed', 'result' => true, 'param' => "ชื่อและนามสกุลนี้ถูกใช้งานแล้ว" ]);
        }
        $chkdata_idcard = DB::table('customer')
        ->where('idcard', $request->n_idcard)
        ->get();
        if (!$chkdata_idcard->isEmpty()) {
            return response()->json([ 'status' => 'failed', 'result' => true, 'param' => "เลขบัตรประชาชนนี้ถูกใช้งานแล้ว" ]);
        }
        $chkdata_tel = DB::table('customer')
        ->where('tel', $request->n_tel)
        ->get();
        if (!$chkdata_tel->isEmpty()) {
            return response()->json([ 'status' => 'failed', 'result' => true, 'param' => "เบอร์โทรศัพท์นี้ถูกใช้งานแล้ว" ]);
        }

        $rescode = DB::table('customer')
            ->orderBy('code', 'DESC')
            ->first();
        $prefix = "CUS-";
        if ($rescode) {
            $code_current = explode('-',$rescode->code)[1];
            $code_new = sprintf("%05d", (int)$code_current + 1);
            $gencode = $prefix . $code_new;
        } else {
            $gencode = $prefix . "00001";
        }

        $arr_data = array(
            "code" => $gencode,
            "customertype_id" => $request->n_customertype,
            "fname" => $request->n_fname,
            "lname" => $request->n_lname,
            "bdate" => $request->n_birthdate,
            "idcard" => $request->n_idcard,
            "bloodtype" => $request->n_bloodtype,
            "email" => $request->n_email,
            "tel" => $request->n_tel,
            "addr" => $request->n_addr,
            "active" => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        );
        $res = DB::table('customer')
        ->insertOrIgnore($arr_data);

        return response()->json([ 'status' => 'success', 'result' => true, 'param' => $res, 'customercode' => $gencode ]);
    }

    public function getdatacusttype(Request $request) {
        $data = DB::table('customer_type')
            ->where('active', 1)
            ->get();
            return response()->json([ 'status' => 'success', 'data' => $data ]);
    }

    public function edit($id) {
        $res = DB::table('customer')
            ->join('customer_type', 'customer_type.id', '=', 'customer.customertype_id')
            ->select(
                'customer_type.name as customertype_name',
                'customer.*')
            ->where('customer.id', $id)
            ->first();
        return view('customer.edit', compact('res') );
    }

    public function update(Request $request) {
        $chkdata_name = DB::table('customer')
        ->where('fname', $request->n_fname)
        ->where('lname', $request->n_lname)
        ->where('id','<>', $request->id)
        ->get();
        if (!$chkdata_name->isEmpty()) {
            return response()->json([ 'status' => 'failed', 'result' => true, 'param' => "ชื่อและนามสกุลนี้ถูกใช้งานแล้ว" ]);
        }
        $chkdata_idcard = DB::table('customer')
        ->where('idcard', $request->n_idcard)
        ->where('id','<>', $request->id)
        ->get();
        if (!$chkdata_idcard->isEmpty()) {
            return response()->json([ 'status' => 'failed', 'result' => true, 'param' => "เลขบัตรประชาชนนี้ถูกใช้งานแล้ว" ]);
        }
        $chkdata_tel = DB::table('customer')
        ->where('tel', $request->n_tel)
        ->where('id','<>', $request->id)
        ->get();
        if (!$chkdata_tel->isEmpty()) {
            return response()->json([ 'status' => 'failed', 'result' => true, 'param' => "เบอร์โทรศัพท์นี้ถูกใช้งานแล้ว" ]);
        }

        $arr_data = array(
            "customertype_id" => $request->n_customertype,
            "fname" => $request->n_fname,
            "lname" => $request->n_lname,
            "bdate" => $request->n_birthdate,
            "idcard" => $request->n_idcard,
            "bloodtype" => $request->n_bloodtype,
            "email" => $request->n_email,
            "tel" => $request->n_tel,
            "addr" => $request->n_addr,
            "active" => $request->active,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        );
        $update = DB::table('customer')
            ->where('id', $request->id)
            ->update($arr_data);
        return response()->json([ 'status' => 'success', 'result' => true, 'param' => $update ]);
    }
}

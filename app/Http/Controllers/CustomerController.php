<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CustomerController extends Controller
{
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
}

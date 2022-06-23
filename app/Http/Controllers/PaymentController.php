<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function __construct() {
        $this->middleware('checksession');
    }

    public function insert(Request $request) {
        //Check Running Payment No
        $rescode = DB::table('orders_payment')
            ->orderBy('code', 'DESC')
            ->first();
        $prefix = "PAY".Carbon::now()->format('ym')."-";
        if ($rescode) {
            if (Carbon::parse($rescode->paymentdate)->format('Y-m-d') != Carbon::now()->format('Y-m-d')) {
                $gencode = $prefix . "00001";
            } else {
                $code_current = explode('-',$rescode->code)[1];
                $code_new = sprintf("%05d", (int)$code_current + 1);
                $gencode = $prefix . $code_new;
            }
        } else {
            $gencode = $prefix . "00001";
        }
        // Check round
        $resround = DB::table('orders_payment')
            ->where('order_code', $request->order_code)
            ->orderBy('round', 'DESC')
            ->first();
        if($resround) {
            $genround = $resround->round+1;
        } else {
            $genround = 1;
        }
        $arr_data = array(
            "code" => $gencode,
            "order_code" => $request->order_code,
            "round" => $genround,
            "paymenttype_id" => $request->paymenttype_id,
            "price_paid" => $request->price_paid,
            "evidence_file" => '',
            "remark" => $request->remark,
            "paymentdate" => Carbon::now()->format('Y-m-d H:i:s'),
            "payment_status" => 1,
            "creator" => $request->creator,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        );
        $res = DB::table('orders_payment')
        ->insertOrIgnore($arr_data);
        return response()->json([ 'status' => 'success', 'result' => true, 'param' => $res ]);
    }

    public function list(Request $request) {
        $res = DB::table('orders_payment as op')
            ->join('payment_type as pt', 'pt.id', '=', 'op.paymenttype_id')
            ->select(
                'pt.name as paymenttype_name',
                'pt.evidence',
                'op.*'
            )
            ->where('op.order_code', $request->order_code)
            ->orderBy('op.round', 'ASC')
            ->get();
            // dd($res);
        return response()->json([ 'status' => 'success', 'result' => true, 'data' => $res ]);
    }
}

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
            if (Carbon::parse($rescode->paymentdate)->format('Y-m') != Carbon::now()->format('Y-m')) {
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
            "evidence_file" => '', //
            "remark" => $request->remark,
            "paymentdate" => Carbon::now()->format('Y-m-d H:i:s'),
            "payment_status" => 1,
            "creator" => $request->creator,
            "operator" => $request->operator,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        );
        $res = DB::table('orders_payment')
        ->insertOrIgnore($arr_data);
        return response()->json([ 'status' => 'success', 'result' => true, 'param' => $res, 'code' => $gencode ]);
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
        return response()->json([ 'status' => 'success', 'result' => true, 'data' => $res ]);
    }

    public function getdata(Request $request) {
        $res = DB::table('orders_payment as op')
            ->join('payment_type as pt', 'pt.id', '=', 'op.paymenttype_id')
            ->select(
                'pt.name as paymenttype_name',
                'pt.evidence',
                'op.*'
            )
            ->where('op.code', $request->paymentcode)
            ->first();

        $paymenttype = DB::table('payment_type')
            ->where('active', 1)
            ->get();
        return response()->json([ 'status' => 'success', 'result' => true, 'data' => $res, 'paymenttype' => $paymenttype ]);
    }

    public function update(Request $request) {
        $arr_data = array(
            "paymenttype_id" => $request->paymenttype_id,
            "price_paid" => $request->price_paid,
            "evidence_file" => '',
            "remark" => $request->remark,
            "operator" => $request->operator,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        );
        $res = DB::table('orders_payment')
        ->where('code', $request->payment_code)
        ->update($arr_data);
        return response()->json([ 'status' => 'success', 'result' => true, 'param' => $res ]);
    }

    public function cancle(Request $request) {
        $arr_data = array(
            "payment_status" => 0,
            "operator" => $request->operator,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        );
        $res = DB::table('orders_payment')
        ->where('code', $request->payment_code)
        ->update($arr_data);
        return response()->json([ 'status' => 'success', 'result' => true, 'param' => $res ]);
    }

    public function resend(Request $request) {
        $arr_data = array(
            "payment_status" => 1,
            "operator" => $request->operator,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        );
        $res = DB::table('orders_payment')
        ->where('code', $request->payment_code)
        ->update($arr_data);
        return response()->json([ 'status' => 'success', 'result' => true, 'param' => $res ]);
    }

    public function disapprove(Request $request) {
        $arr_data = array(
            "payment_status" => 2,
            "operator" => $request->operator,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        );
        $res = DB::table('orders_payment')
        ->where('code', $request->payment_code)
        ->update($arr_data);
        return response()->json([ 'status' => 'success', 'result' => true, 'param' => $res ]);
    }

    public function approve(Request $request) {
        $res = DB::table('orders_payment as op')
        ->join('orders as o', 'o.code', '=', 'op.order_code')
        ->select(
            'o.status_order',
            'o.price_paid as orders_price_paid',
            'o.price_balance as orders_price_balance',
            'op.*'
        )
        ->where('op.code', $request->payment_code)
        ->first();

        $newpricebalance = $res->orders_price_balance - $res->price_paid;
        $newpricepaid = $res->price_paid + $res->orders_price_paid;
        if($newpricebalance <= 0) {
            $arr_data_orders = array(
                "status_order" => 3,
                "price_paid" => $newpricepaid,
                "price_balance" => $newpricebalance,
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            );
            DB::table('orders')
            ->where('code', $res->order_code)
            ->update($arr_data_orders);
        }
        if($newpricepaid != 0 && $newpricebalance > 0) {
            $arr_data_orders = array(
                "status_order" => 2,
                "price_paid" => $newpricepaid,
                "price_balance" => $newpricebalance,
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            );
            DB::table('orders')
            ->where('code', $res->order_code)
            ->update($arr_data_orders);
        }

        $arr_data = array(
            "payment_status" => 3,
            "approver" => $request->approver,
            "approvedate" => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        );
        $update = DB::table('orders_payment')
        ->where('code', $request->payment_code)
        ->update($arr_data);
        return response()->json([ 'status' => 'success', 'result' => true ]);
    }

    public function upload(Request $request) {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $destinationPath = public_path('/payment_evidence/');
            $profileImage = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileImage);

            $arr_data = array(
                "evidence_file" => $profileImage
            );
            $update = DB::table('orders_payment')
            ->where('code', $request->code)
            ->update($arr_data);

            return response()->json(['status' => 'success', 'filename' => $profileImage]);
        } else {
            return response()->json(['status' => 'error']);
        }
    }


}

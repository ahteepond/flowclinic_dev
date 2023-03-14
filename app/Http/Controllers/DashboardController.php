<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function __construct() {
        $this->middleware('checksession');
    }
    
    public function index() {

        $first_day_this_month = date('Y-m-01');
        $last_day_this_month  = date('Y-m-t');

        // จำนวนลูกค้าทั้งหมด
        $customer = DB::table('customer')
        ->where('active', 1)
        ->get();
        $count_customer = $customer->count();

        // จำนวนบริการทั้งหมด
        $service = DB::table('service')
        ->where('active', 1)
        ->get();
        $count_service = $service->count();
        
        // จำนวนคำสั่งซื้อเดือนนี้
        $order = DB::table('orders')
        ->whereBetween('orderdate', [$first_day_this_month.' 00:00:00', $last_day_this_month.' 23:59:59'])
        ->get();
        $count_order = $order->count();

        // จำนวนนัดหมายเดือนนี้
        $appointment = DB::table('appointment')
        ->whereBetween('appointment_date', [$first_day_this_month, $last_day_this_month])
        ->get();
        $count_appointment = $appointment->count();

        return view('dashboard', compact('count_customer', 'count_service', 'count_order', 'count_appointment'));
    }
}

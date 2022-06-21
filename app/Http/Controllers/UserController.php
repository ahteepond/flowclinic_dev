<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserController extends Controller
{

    public function __construct() {
        $this->middleware('checksession');
    }

    public function resetpassword(Request $request) {
        $update = DB::table('user')
            ->where('emp_code', $request->empcode)
            ->update(["resetpassword" => 1]);
        return response()->json([ 'status' => 'success', 'result' => true, 'param' => $update ]);
    }

    public function info() {
        $res = DB::table('employee')
            ->select('employee.*', 'employee_position.emp_posi_id', 'employee_position.emp_posi_name')
            ->join('employee_position', 'employee.emp_posi_id', '=', 'employee_position.emp_posi_id')
            ->where('emp_code', session()->get('session_empcode'))
            ->first();
        $res_empposi = DB::table('employee_position')
            ->get();
        return view('user.info', compact('res', 'res_empposi') );
    }

    public function updateimgprofile(Request $request) {
        $arr_data = array(
            "emp_img" => $request->empimg,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        );
        $update = DB::table('employee')
            ->where('emp_code', $request->empcode)
            ->update($arr_data);

        if (session()->get('session_empcode') == $request->empcode) {
            session(['session_empimg' => $request->empimg]);
        }

        return response()->json([ 'status' => 'success', 'result' => true, 'param' => $update ]);
    }
}

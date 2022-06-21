<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index() {
        return view('login');
    }

    public function checklogin(Request $request) {
        $rule = array(
            'username' => 'required',
            'password' => 'required'
        );
        $error = Validator::make($request->all(), $rule);
        if ($error->fails()) {
            return response()->json([
                'status' => 'error',
                'result' => $error->errors()->all(),
            ]);
        };

        $checkemp = DB::table('employee')
        ->where(['emp_code' => $request->username ])
        ->where(['active' => 1 ])
        ->first();

        if(!empty($checkemp)) {
            $select = DB::table('user')
            ->where(['username' => $request->username ])
            ->where(['active' => 1 ])
            ->first();
            $chk = Hash::check($request->password, $select->password);
            if ($chk == false) { return response()->json([ 'status' => 'success', 'param' => false ]); };
            if ($chk == true) {
                if ($select->resetpassword === 1) {
                    return response()->json([
                        'status' => 'success',
                        'param' => 'reset',
                        'value' =>  $select->username,
                    ]);
                };
                if ($select->password_exp <= Carbon::now()) {
                    return response()->json([
                        'status' => 'success',
                        'param' => 'expired',
                        'value' =>  $select->username,
                    ]);
                };
                self::setSession($select->username);
                return response()->json([ 'status' => 'success', 'param' => true ]);
            };
        } else {
            return response()->json([ 'status' => 'success', 'param' => false ]);
        }
    }

    public static function setSession($username) {
        $select = DB::table('user')
            ->join('employee', 'user.emp_code', '=', 'employee.emp_code')
            ->join('employee_position', 'employee.emp_posi_id', '=', 'employee_position.emp_posi_id')
            ->select('user.*', 'employee.emp_fname_th', 'employee.emp_lname_th', 'employee.emp_img', 'employee_position.emp_posi_name')
            ->where(['user.username' => $username ])
            ->first();
        session(['session_role' => $select->role]);
        session(['session_username' => $select->username]);
        session(['session_userid' => $select->user_id]);
        session(['session_empcode' => $select->emp_code]);
        session(['session_fullname' => $select->emp_fname_th . " " . $select->emp_lname_th]);
        session(['session_empposition' => $select->emp_posi_name]);
        session(['session_empimg' => $select->emp_img]);
    }

    public function changePassword(Request $request) {
        $select = DB::table('user')
            ->where(['username' => $request->username ])
            ->first();
        $username = $request->username;
        return view('changepassword', compact('username'));
    }

    public function updatePassword(Request $request) {
        $rule = array(
            'tel' => 'required',
            'birthdate' => 'required',
            'new_password' => 'required',
            'new_password_cfm' => 'required'
        );

        $username = $request->username;
        $tel = $request->tel;
        $birthdate = $request->birthdate;
        $new_password = $request->new_password;
        $new_password_cfm = $request->new_password_cfm;

        if (empty($new_password) || empty($new_password_cfm) || empty($tel) || empty($birthdate)) {
            return response()->json([ 'status' => 'success', 'param' => false, 'result' => 'กรุณากรอกข้อมูลให้ครบ' ]);
        };

        $select = DB::table('user')
            ->join('employee', 'user.emp_code', '=', 'employee.emp_code')
            ->select('user.*', 'employee.emp_tel', 'employee.emp_birthdate')
            ->where(['user.username' => $username ])
            ->where(['employee.emp_tel' => $tel ])
            ->whereDate('employee.emp_birthdate', '=', $birthdate)
            ->first();

        if (empty($select)) {
            return response()->json([ 'status' => 'success', 'param' => false, 'result' => 'ข้อมูลเบอร์โทรศัพท์และวันเกิดไม่ถูกต้อง กรุณาตรวจสอบอีกครั้ง' ]);
        };

        if ($new_password != $new_password_cfm) {
            return response()->json([ 'status' => 'success', 'param' => false, 'result' => 'รหัสผ่านใหม่และยืนยันรหัสผ่านใหม่ไม่ตรงกัน กรุณาตรวจสอบอีกครั้ง' ]);
        };

        $error = Validator::make($request->all(), $rule);
        if ($error->fails()) {
            return response()->json([
                'status' => 'error',
                'result' => $error->errors()->all(),
            ]);
        } else {
            DB::table('user')
                ->where('username', $username)
                ->update([
                    'password' => Hash::make( $new_password ),
                    'resetpassword' => 0,
                    'updated_at' => Carbon::now()
                ]);
            return response()->json([ 'status' => 'success', 'param' => true ]);
        };

    }

    public function logout() {
        session()->flush();
        return redirect('login');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{

    public function __construct() {
        $this->middleware('checksession');
    }

    public function index() {
        $res_empposi = DB::table('employee_position')
            ->get();
        return view('employee.index', compact('res_empposi') );
    }

    public function list(Request $request) {
        if ($request->ajax()) {
            $data = DB::table('employee');
            $data = $data->select('employee.*', 'employee_position.emp_posi_id', 'employee_position.emp_posi_name');
            $data = $data->join('employee_position', 'employee.emp_posi_id', '=', 'employee_position.emp_posi_id');
            $data = $data->where('employee.active', $request->active);
            if ($request->position != "All") {
                $data = $data->where('employee.emp_posi_id', $request->position);
            }
            $data = $data->get();
            return DataTables::of($data)
                ->addIndexColumn()
                 ->addColumn('empcode', function($row){
                    $empcode = $row->emp_code;
                    return $empcode;
                })
                ->addColumn('empfullname', function($row){
                    $empfullname = $row->emp_fname_th . " " . $row->emp_lname_th;
                    return $empfullname;
                })
                ->addColumn('empposition', function($row){
                    $empposition = $row->emp_posi_name;
                    return $empposition;
                })
                ->addColumn('emptel', function($row){
                    if ($row->emp_tel == "") {
                        $emptel = "-";
                    } else {
                        $emptel = $row->emp_tel;
                    }
                    return $emptel;
                })
                ->addColumn('active', function($row){
                    $int_active = $row->active;
                    if ($int_active == 0) { $active = '<span class="badge bg-danger-transparent rounded-pill text-danger p-2 px-3">Inactive</span>'; }
                    if ($int_active == 1) { $active = '<span class="badge bg-success-transparent rounded-pill text-success p-2 px-3">Active</span>'; }
                    return $active;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" title="รายละเอียด" onclick="view('."'".$row->emp_code."'".')" class="btn text-info btn-sm"><i class="ion-more"></i></a>';
                    $btn .= '<a href="javascript:void(0)" title="แก้ไข" onclick="edit('."'".$row->emp_code."'".')" class="btn text-primary btn-sm"><span class="fe fe-edit"></span></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'active'])
                ->make(true);
        }
    }

    public function new() {
        $res_empposi = DB::table('employee_position')
            ->get();
        return view('employee.new', compact('res_empposi') );
    }

    public function insert(Request $request) {
        $arr_data_emp = array(
            "emp_code" => $request->empcode,
            "emp_fname_th" => $request->empfname,
            "emp_lname_th" => $request->emplname,
            "emp_posi_id" => $request->empposi,
            "emp_tel" => $request->emptel,
            "emp_email" => $request->empemail,
            "emp_birthdate" => $request->empbirthdate,
            "emp_img" => $request->empimg,
            "active" => $request->active,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        );
        $res_emp = DB::table('employee')
        ->insertOrIgnore($arr_data_emp);

        switch ($request->empposi) {
            case '1': $role = "sa"; break;
            case '2': $role = "ac"; break;
            case '3': $role = "or"; break;
            case '4': $role = "do"; break;
            case '5': $role = "ad"; break;
            case '6': $role = "su"; break;
        }
        $arr_data_user = array(
            "emp_code" => $request->empcode,
            "username" => $request->empcode,
            "password" => Hash::make("flowclinic1234"),
            "password_exp" => "2999-01-01 00:00:00",
            "role" => $role,
            "resetpassword" => 1,
            "active" => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        );
        $res_user = DB::table('user')
        ->insertOrIgnore($arr_data_user);

        return response()->json([ 'status' => 'success', 'result' => true, 'param' => $res_emp ]);
    }

    public function view($empcode) {
        $res = DB::table('employee')
            ->select('employee.*', 'employee_position.emp_posi_id', 'employee_position.emp_posi_name')
            ->join('employee_position', 'employee.emp_posi_id', '=', 'employee_position.emp_posi_id')
            ->where('emp_code', $empcode)
            ->first();
        $res_empposi = DB::table('employee_position')
            ->get();
        return view('employee.view', compact('res', 'res_empposi') );
    }

    public function edit($empcode) {
        $res = DB::table('employee')
            ->select('employee.*', 'employee_position.emp_posi_id', 'employee_position.emp_posi_name')
            ->join('employee_position', 'employee.emp_posi_id', '=', 'employee_position.emp_posi_id')
            ->where('emp_code', $empcode)
            ->first();
        $res_empposi = DB::table('employee_position')
            ->get();
        return view('employee.edit', compact('res', 'res_empposi') );
    }

    public function update(Request $request) {
        $arr_data = array(
            "emp_fname_th" => $request->empfname,
            "emp_lname_th" => $request->emplname,
            "emp_posi_id" => $request->empposi,
            "emp_tel" => $request->emptel,
            "emp_email" => $request->empemail,
            "emp_img" => $request->empimg,
            "emp_birthdate" => $request->empbirthdate,
            "active" => $request->active,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        );
        $update = DB::table('employee')
            ->where('emp_id', $request->id)
            ->where('emp_code', $request->empcode)
            ->update($arr_data);

        if (session()->get('session_empcode') == $request->empcode) {
            session(['session_empimg' => $request->empimg]);
        }

        return response()->json([ 'status' => 'success', 'result' => true, 'param' => $update ]);
    }

    public function generateEmpcode(Request $request) {
        $resprefix = DB::table('employee_position')
        ->where('emp_posi_id', $request->empposi)
        ->first();
        $rescode = DB::table('employee')
        ->orderBy(DB::raw('RIGHT(emp_code, 5)'), 'DESC')
        ->first();
        $prefix = $resprefix->prefix;
        if ($rescode) {
            $code_new = $code_new = sprintf("%05d", preg_replace('/[^0-9]/', '', $rescode->emp_code)+1);
            $gencode = $prefix . $code_new;
        } else {
            $gencode = $prefix . "00001";
        }
        return response()->json([ 'status' => 'success', 'result' => true, 'param' => $gencode ]);
    }
}

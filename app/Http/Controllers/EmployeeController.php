<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
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
                    $btn = '<a href="javascript:void(0)" title="รายละเอียด" onclick="view('.$row->emp_code.')" class="btn text-info btn-sm"><i class="ion-more"></i></a>';
                    $btn .= '<a href="javascript:void(0)" title="แก้ไข" onclick="edit('.$row->emp_code.')" class="btn text-primary btn-sm"><span class="fe fe-edit"></span></a>';
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
        $arr_data = array(
            "emp_code" => $request->empcode,
            "emp_fname_th" => $request->empfname,
            "emp_lname_th" => $request->emplname,
            "emp_posi_id" => $request->empposi,
            "emp_tel" => $request->emptel,
            "emp_email" => $request->empemail,
            "active" => $request->active,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        );
        $res = DB::table('employee')
        ->insertOrIgnore($arr_data);
        return response()->json([ 'status' => 'success', 'result' => true, 'param' => $res ]);
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
            "active" => $request->active,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        );
        $update = DB::table('employee')
            ->where('emp_id', $request->id)
            ->where('emp_code', $request->empcode)
            ->update($arr_data);
        return response()->json([ 'status' => 'success', 'result' => true, 'param' => $update ]);
    }
}

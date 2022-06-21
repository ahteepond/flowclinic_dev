<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckPaymentController extends Controller
{

    public function __construct() {
        $this->middleware('checksession');
    }
    
    public function index() {
        return view('checkpayment.index');
    }

    public function view() {
        return view('checkpayment.view');
    }

}

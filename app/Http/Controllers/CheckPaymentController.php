<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckPaymentController extends Controller
{
    public function index() {
        return view('checkpayment.index');
    }

    public function view() {
        return view('checkpayment.view');
    }

}

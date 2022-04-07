<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentTypeController extends Controller
{
    public function index() {
        return view('paymenttype.index');
    }

    public function new() {
        return view('paymenttype.new');
    }

    public function edit() {
        return view('paymenttype.edit');
    }

}

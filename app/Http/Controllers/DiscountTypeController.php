<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiscountTypeController extends Controller
{
    public function index() {
        return view('discounttype.index');
    }

    public function new() {
        return view('discounttype.new');
    }

    public function edit() {
        return view('discounttype.edit');
    }
}

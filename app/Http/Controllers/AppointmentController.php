<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppointmentController extends Controller
{

    public function index() {
        return view('appointment.index');
    }

    public function new() {
        return view('appointment.new');
    }

    public function history() {
        return view('appointment.history');
    }

}

<?php

namespace App\Http\Controllers\attendance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(){
        return view('content.attendance.attendance');
    }
    public function userAttendance(){
        return view('content.attendance.my-attendance');
    }
}

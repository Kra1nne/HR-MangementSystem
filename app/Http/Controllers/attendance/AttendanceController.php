<?php

namespace App\Http\Controllers\attendance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(){
        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Attendance Dashboard'],
        ];
        return view('content.attendance.attendance', compact('breadcrumbs'));
    }
    public function userAttendance(){
        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'My Attendance'],
        ];
        return view('content.attendance.my-attendance', compact('breadcrumbs'));
    }
    public function faceRecognation(){
        return view('content.attendance.attendance-check');
    }
}

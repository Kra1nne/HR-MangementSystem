<?php

namespace App\Http\Controllers\attendance;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function employeeData()
    {
        $employeeData = Employee::leftJoin('persons', 'persons.id', '=', 'employees.person_id')
            ->leftJoin('users', 'users.person_id', '=', 'employees.person_id')
            ->where('users.id', Auth::id())
            ->first();

        $descriptor = json_decode($employeeData->face_descriptor, true);

        return response()->json([
            'employee' => $employeeData->firstname . ' ' . $employeeData->lastname,
            'descriptor' => $descriptor
        ]);
    }
}

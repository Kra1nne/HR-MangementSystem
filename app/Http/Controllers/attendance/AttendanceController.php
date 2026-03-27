<?php

namespace App\Http\Controllers\attendance;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeLog;
use App\Models\User;
use Carbon\Carbon;
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
    public function attendace()
    {
        $employeeData = User::leftjoin('persons','persons.id', '=', 'users.person_id')
            ->leftjoin('employees', 'employees.person_id', '=', 'persons.id')
            ->leftjoin('department_employees', 'department_employees.emp_no', '=', 'employees.emp_no')
            ->where('users.id', Auth::id())
            ->whereNull('users.deleted_at')
            ->select('employees.emp_no as id', 'department_employees.id_no as emp_id')
            ->first();
            
        $latestLog = EmployeeLog::where('dept_employee_id', $employeeData->emp_id)
            ->where('date', now()->toDateString())
            ->orderBy('time', 'desc')
            ->first();
        
        if ($latestLog != null) {
            $time = Carbon::parse($latestLog->time);

            if ($time->addMinutes(10)->isFuture()) {
                return response()->json([
                    'Error' => 1,
                    'Message' => 'Wait at least 10 minutes to time-in/time-out.'
                ]);
            }
        }

        $date = now()->toDateString(); 
        $time = now()->toTimeString();
        
        $data = [
            'dept_employee_id' => $employeeData->emp_id,
            'time' => $time,
            'date' => $date,
            'remarks' => 'Present',
            'created_at' => now()
        ];
        $result = EmployeeLog::insert($data);
        if($result){
            return response()->json(['Error' => 0, 'Message' => 'Attendance Successfully']);
        }
    }
}

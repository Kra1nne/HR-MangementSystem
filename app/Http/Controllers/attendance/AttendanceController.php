<?php

namespace App\Http\Controllers\attendance;

use App\Http\Controllers\Controller;
use App\Models\DepartmentEmployee;
use App\Models\Employee;
use App\Models\EmployeeLog;
use App\Models\User;
use App\Services\PdfService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class AttendanceController extends Controller
{
    public function index(){

        $today = Carbon::today();
        
        $Present = DepartmentEmployee::with(['employee_logs' => function ($query) use ($today) {
                $query->whereDate('date', $today)
                ->orderBy('time', 'asc') 
                ->limit(1); 
            }])
            ->whereHas('employee_logs', function ($query) use ($today) {
                $query->whereDate('date', $today);
            })
            ->leftjoin('employees', 'employees.emp_no', '=', 'department_employees.emp_no')
            ->leftjoin('persons', 'persons.id', '=', 'employees.person_id')
            ->leftjoin('departments','departments.dept_no', '=', 'department_employees.dept_no')
            ->paginate(8, ['*'], 'present_page');
        
        $Absent = DepartmentEmployee::whereDoesntHave('employee_logs', function ($query) use ($today) {
                $query->whereDate('date', $today);
            })
            ->leftjoin('employees', 'employees.emp_no', '=', 'department_employees.emp_no')
            ->leftjoin('persons', 'persons.id', '=', 'employees.person_id')
            ->leftjoin('departments','departments.dept_no', '=', 'department_employees.dept_no')
            ->paginate(8, ['*'], 'absent_page');
       
        $presentCount = $Present->total();
        $totalEmployee = Employee::whereNull('deleted_at')->count();
        $totalAbsent = $Absent->total();
        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Attendance Dashboard'],
        ];
        return view('content.attendance.attendance', compact('breadcrumbs', 'presentCount', 'totalEmployee', 'totalAbsent', 'Present', 'Absent'));
    }
    public function userAttendance(){
        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'My Attendance'],
        ];
        return view('content.attendance.my-attendance', compact('breadcrumbs'));
    }
    public function employeeAttendanceView($id){

        $employeeData = Employee::leftJoin('persons', 'persons.id', '=', 'employees.person_id')
            ->leftJoin('users', 'users.person_id', '=', 'employees.person_id')
            ->where('employees.emp_no', Crypt::decryptString($id))
            ->selectRaw('CONCAT(persons.firstname," ", persons.middlename," ", persons.lastname) as name')
            ->first();

        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Employee DTR', 'link' => route('attendance-employee')],
            ['name' => 'Employee DTR View', 'link']
        ];
        return view('content.attendance.attendance-employee-view', compact('breadcrumbs', 'employeeData'));
    }
    public function employeeAttendance(Request $request){
        $isSearch = false;
        $data = Employee::with(['person', 'latestSalary', 'latestTitle']);

        if($request->search){
            $isSearch = true;
            $data->where('emp_id', 'like', '%'.$request->search.'%');
        }

        $employees = $data->whereNull('deleted_at')
            ->paginate(7);

        $employees->getCollection()->transform(function ($employee) {
            $employee->encrypted_id = Crypt::encryptString($employee->emp_no);
            return $employee;
        });

        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Employee DTR'],
        ];
        return view('content.attendance.attendance-employee', compact('breadcrumbs', 'employees', 'isSearch'));
    }
    public function faceRecognation(){
        $employeeData = User::leftjoin('persons','persons.id', '=', 'users.person_id')
            ->leftjoin('employees', 'employees.person_id', '=', 'persons.id')
            ->leftjoin('department_employees', 'department_employees.emp_no', '=', 'employees.emp_no')
            ->where('users.id', Auth::id())
            ->whereNull('users.deleted_at')
            ->select('employees.emp_no as id', 'department_employees.id_no as emp_id')
            ->first();

        $DTRToday = EmployeeLog::orderBy('dept_employee_id')
            ->orderBy('date')
            ->orderBy('time')
            ->where('dept_employee_id', $employeeData->emp_id)
            ->where('date', now()->toDateString())
            ->get();
        
        return view('content.attendance.attendance-check', compact('DTRToday'));
    }
    public function fetchTodayData()
    {
        $employeeData = User::leftjoin('persons','persons.id', '=', 'users.person_id')
            ->leftjoin('employees', 'employees.person_id', '=', 'persons.id')
            ->leftjoin('department_employees', 'department_employees.emp_no', '=', 'employees.emp_no')
            ->where('users.id', Auth::id())
            ->whereNull('users.deleted_at')
            ->select('employees.emp_no as id', 'department_employees.id_no as emp_id')
            ->first();

        $DTRToday = EmployeeLog::orderBy('dept_employee_id')
            ->orderBy('date')
            ->orderBy('time')
            ->where('dept_employee_id', $employeeData->emp_id)
            ->where('date', now()->toDateString())
            ->get();
        
        return response()->json(['TodayData' => $DTRToday]);
    }
    public function getAttendance()
    {
       $employeeData = User::leftjoin('persons','persons.id', '=', 'users.person_id')
            ->leftjoin('employees', 'employees.person_id', '=', 'persons.id')
            ->leftjoin('department_employees', 'department_employees.emp_no', '=', 'employees.emp_no')
            ->where('users.id', Auth::id())
            ->whereNull('users.deleted_at')
            ->select('employees.emp_no as id', 'department_employees.id_no as emp_id')
            ->first();

        $logs = EmployeeLog::orderBy('dept_employee_id')
            ->orderBy('date')
            ->orderBy('time')
            ->where('dept_employee_id', $employeeData->emp_id)
            ->get();
        
        return response()->json($logs);
    }
    public function getAttendanceEmployee($id)
    {
       $employeeData = User::leftjoin('persons','persons.id', '=', 'users.person_id')
            ->leftjoin('employees', 'employees.person_id', '=', 'persons.id')
            ->leftjoin('department_employees', 'department_employees.emp_no', '=', 'employees.emp_no')
            ->where('users.id', Crypt::decryptString(($id)))
            ->whereNull('users.deleted_at')
            ->select('employees.emp_no as id', 'department_employees.id_no as emp_id')
            ->first();

        $logs = EmployeeLog::orderBy('dept_employee_id')
            ->orderBy('date')
            ->orderBy('time')
            ->where('dept_employee_id', $employeeData->emp_id)
            ->get();

        return response()->json($logs);
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

        $logCount =  EmployeeLog::where('dept_employee_id', $employeeData->emp_id)
            ->where('date', now()->toDateString())
            ->orderBy('time', 'desc')
            ->count();

       if($logCount == 4) return response()->json(['Error' => 1, 'Message' => 'Invalid Attendance.']);

        $row = 1;
        if ($latestLog != null) {
            $time = Carbon::parse($latestLog->time);
            $latestLog->row == 1 ? $row = 2 : $row = 1;
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
            'row' => $row,
            'created_at' => now()
        ];
        $result = EmployeeLog::insert($data);
        if($result){
            return response()->json(['Error' => 0, 'Message' => 'Attendance Successfully']);
        }
    }
    public function viewEmployee(Request $request)
    {
        $data = Employee::with(['person', 'latestSalary', 'latestTitle']);
        $isSearch = false;
        
        if($request->search){
            $data->where('emp_id', 'like', '%'.$request->search.'%');
            $isSearch = true;
        }
        

        $employees = $data->whereNull('deleted_at')
            ->paginate(7);

        $employees->getCollection()->transform(function ($employee) {
            $employee->encrypted_id = Crypt::encryptString($employee->emp_no);
            return $employee;
        });
        
        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Generate DTR'],
        ];

        return view('content.employee_dtr.dtr', compact('isSearch','employees'));
    }
    public function preview(PdfService $pdfService, Request $request)
    {

        $employeeData = User::leftjoin('persons','persons.id', '=', 'users.person_id')
            ->leftjoin('employees', 'employees.person_id', '=', 'persons.id')
            ->leftjoin('department_employees', 'department_employees.emp_no', '=', 'employees.emp_no')
            ->where('users.id', Crypt::decryptString($request->id))
            ->whereNull('users.deleted_at')
            ->select('employees.emp_no as id', 'department_employees.id_no as emp_id')
            ->first();

        $logs = EmployeeLog::orderBy('dept_employee_id')
            ->orderBy('date')
            ->orderBy('time')
            ->where('dept_employee_id', $employeeData->emp_id)
            ->whereMonth('date', $request->month)
            ->whereYear('date', $request->year)
            ->get();

        $personData = Employee::with('latestDepartment.department', 'person')
            ->where('emp_no', $employeeData->id)
            ->first();
        
        if(!$employeeData->emp_id){
            return back()->with('error', 'Invalid DTR Generate.');
        }    
       
        // Group logs by day
        $grouped = $logs->groupBy(function ($log) {
            return Carbon::parse($log->date)->day;
        });
        
        $info = [
            ['Employee',   $personData->person->firstname . ' ' . $personData->person->middlename[0] . ' ' . $personData->person->lastname],
            ['Department', $personData->latestDepartment->department->dept_name],
            ['Employee ID', $personData->emp_id],
            ['Generated',  date('M d, Y')],
        ];

        $daysInMonth = Carbon::create($request->year, $request->month, 1)->daysInMonth;

        // Build final array
        $result = [];

        for ($i = 1; $i <= $daysInMonth; $i++) {
            $result[$i] = $grouped[$i] ?? [];
        }

        return $pdfService->generate($result, $info);
    }
}

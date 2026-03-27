<?php

namespace App\Http\Controllers\department;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DepartmentEmployee;
use App\Models\Employee;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpFoundation\JsonResponse;

class DepartmentController extends Controller
{
    public function index(){
        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Department List', 'link'],
        ];

        $departments = Department::whereNull('deleted_at')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($department) {
                $department->dept_no = Crypt::encryptString($department->dept_no);
                return $department;
            });

        return view('content.department.department-list', compact('departments', 'breadcrumbs'));
    }
    public function details($id, Request $request){
        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Department List', 'link' => route('department-list')],
            ['name' => 'Department Details'],
        ];
        $departmentDetails = Department::whereNull('deleted_at')
            ->where('dept_no', Crypt::decryptString($id))
            ->orderBy('created_at', 'desc')
            ->first();
            
        if ($departmentDetails) {
            $departmentDetails->encrypted_id = Crypt::encryptString($departmentDetails->dept_no);
        }

        $data = Employee::with(['person', 'latestSalary', 'latestTitle'])
            ->leftjoin('department_employees', 'department_employees.emp_no', '=', 'employees.emp_no')
            ->where('department_employees.dept_no', Crypt::decryptString($id))
            ->where('department_employees.status', '=', 'active')
            ->whereNull('department_employees.to_date');

        if($request->search)
        {
            $data->where('employees.emp_id',  'like', '%'.$request->search.'%');
        }

        $departmentEmployee = $data->where('employees.deleted_at')
            ->paginate(10);
        
        $employees = Employee::with('person', 'latestTitle')
            ->whereNotIn('employees.emp_no', function ($query) {
                $query->select('emp_no')
                    ->from('department_employees')
                    ->where('status', '!=', 'remove')
                    ->whereNull('to_date');
            })
            ->orderBy('hire_date', 'Desc')
            ->get();
        
        return view('content.department.department-details', compact('departmentDetails', 'breadcrumbs', 'employees', 'departmentEmployee'));
    }
    public function addDepartment(Request $request)
    {
        $data = [
            'dept_name' => $request->name,
            'details' => $request->details,
            'icon' => $request->departmentIcon,
            'created_at' => now()
        ];
        $log = [
            'user_id' => Auth::id(),
            'action' => 'Add',
            'table_name' => 'Departments',
            'description' => 'Added a department',
            'ip_address' => request()->ip(),
            'created_at' => now(),
        ];
        
        $isCreated = Department::insert($data);
        $logData = Log::insert($log);

        if($isCreated && $logData){
            return response()->json(['Error' => 0, 'Message' => 'Successfully added a new Department']);
        }
    }
    public function addEmployee(Request $request)
    {
        if(empty($request->employee)){
            return response()->json(['Error' => 1, 'Message' => 'Invalid Add Employee']);
        }
        foreach($request->employee as $data){
            DepartmentEmployee::insert( [
                'emp_no' => (int) $data,
                'dept_no' => $request->id,
                'from_date' => now(),
                'status' => 'active',
                'created_at' => now(),
            ]);
        }

         $log = [
            'user_id' => Auth::id(),
            'action' => 'Add',
            'table_name' => 'Departments Employee',
            'description' => 'Added a employee',
            'ip_address' => request()->ip(),
            'created_at' => now(),
        ];
        $logData = Log::insert($log);

        return response()->json(['Error' => 0, 'Message' => 'Successfully added a Employee']);
    }
    public function removeEmployee(Request $request)
    {
        $data = [
            'status' => 'remove',
            'to_date' => now()
        ];
        $result = DepartmentEmployee::where('id_no', $request->id)->update($data);

        if($result)
        {
            return response()->json(['Error' => 0, 'Message' => 'Successfully remove a Employee']);
        }
        
    }
}

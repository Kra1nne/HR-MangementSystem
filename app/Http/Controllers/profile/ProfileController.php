<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;


class ProfileController extends Controller
{
    public function index($id)
    {
        $data = Employee::with(['person.user', 'latestSalary', 'latestTitle', 'latestDepartment.department', 'histories'])
            ->where('emp_no', Crypt::decryptString($id))
            ->first();

        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Employee', 'link' => route('employee', $id)],
            ['name' => 'Employee Details'],
        ];
        $employee_id = $id;
        //dd($data);
        return view('content.accounts.profile', compact('data', 'employee_id', 'breadcrumbs'));
    }
    public function profileDepartment($id)
    {
        $data = Employee::with(['person.user', 'latestSalary', 'latestTitle', 'latestDepartment.department', 'histories'])
            ->where('emp_no', Crypt::decryptString($id))
            ->first();

        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Department List', 'link' => route('department-list')],
            ['name' => 'Department Details', 'link' => route('department-details', Crypt::encryptString($data->latestDepartment->dept_no))],
            ['name' => 'Employee Details'],
        ];
        
        $employee_id = $id;

        return view('content.accounts.profile-department', compact('data', 'employee_id', 'breadcrumbs'));
    }
    public function addExperience(Request $request)
    {
        if($request->start > $request->end || $request->start > now()->toDateString() || $request->end > now()->toDateString()){
            return response()->json(['Error' => 1, 'Message' => 'Unable to add, error date']);
        }
        $data = [
            'emp_no' => Crypt::decryptString($request->emp_no),
            'company' => $request->company,
            'position' => $request->position,
            'salary' => $request->salary,
            'description' => $request->description,
            'start_date' => $request->start, 
            'to_date' => $request->end
        ];

        $result = EmployeeHistory::insert($data);

        if(!$result){
            return response()->json(['Error' => 0, 'Message' => 'Unabale to add a experience']);
        }

        return response()->json(['Error' => 0, 'Message' => 'Successfully add the experience']);
    }
    public function deleteExperience(Request $request){
        $result = EmployeeHistory::where('id', $request->id)->delete();

        if(!$result){
            return response()->json(['Error' => 0, 'Message' => 'Unabale to delete a experience']);
        }

        return response()->json(['Error' => 0, 'Message' => 'Successfully deleted the experience']);
    }
    public function updateExperience(Request $request){

        if($request->start > $request->end || $request->start > now()->toDateString() || $request->end > now()->toDateString()){
            return response()->json(['Error' => 1, 'Message' => 'Unable to add, error date']);
        }
        $data = [
            'emp_no' => Crypt::decryptString($request->emp_no),
            'company' => $request->company,
            'position' => $request->position,
            'salary' => $request->salary,
            'description' => $request->description,
            'start_date' => $request->start, 
            'to_date' => $request->end
        ];

         $result = EmployeeHistory::where('id', $request->id)->update($data);

        if(!$result){
            return response()->json(['Error' => 0, 'Message' => 'Unabale to add a experience']);
        }

        return response()->json(['Error' => 0, 'Message' => 'Successfully add the experience']);
    }
}

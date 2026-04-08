<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Models\DepartmentEmployee;
use App\Models\Employee;
use App\Models\Log;
use App\Models\Person;
use App\Models\Salary;
use App\Models\Title;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class EmployeeController extends Controller
{
    public function index(Request $request){
        
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
            ['name' => 'Employee'],
        ];
        return view('content.employee.employee', compact('breadcrumbs','employees', 'isSearch'));
    }
    public function registerFace($id){
        
        return view('content.employee.face-registration', compact('id'));
    }
    public function addEmployee(Request $request){
        $dataPersonal = [
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'address' => $request->address,
            'phone_number' => $request->phone,
            'birth_date' => $request->birth_date,
            'sex' => $request->sex,
            'blood_type' => $request->blood_type,
            'created_at' => now(),
        ];
        $person = Person::create($dataPersonal);
        $dataEmployee = [
            'person_id' => $person->id,
            'emp_id' => $request->emp_id,
            'hire_date' => $request->hire_date,
            'status' => $request->status,
            'created_at' => now(),
        ];
        $employee = Employee::create($dataEmployee);
  
        $dataSalary = [
            'emp_no' => $employee->id,
            'salary' => $request->salary,
            'from_date' => $request->hire_date,
            'created_at' => now()
        ];
        $dataTitle = [
            'emp_no' => $employee->id,
            'title' => $request->position,
            'from_date' => $request->hire_date
        ];
        $title = Title::insert($dataTitle);
        $salary = Salary::insert($dataSalary);
        
        $log = [
            'user_id' => Auth::id(),
            'action' => 'Add',
            'table_name' => 'Employee',
            'description' => 'Added a employee',
            'ip_address' => request()->ip(),
            'created_at' => now(),
        ];
        $logData = Log::insert($log);

        if($employee && $salary && $title){
            return response()->json(['Error' => 0, 'Message' => 'Successfulyy added a new Employee']);
        }
    }
    public function editEmployee(Request $request){
        $id = $request->idNumber;
        $id_salary = $request->id_salary;
        $id_title = $request->id_title;

        $employeeData = Employee::whereNull('deleted_at')
            ->where('emp_no', '=', $id)
            ->first();

        $dataPerson = [
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'address' => $request->address,
            'phone_number' => $request->phone,
            'birth_date' => $request->birth_date,
            'sex' => $request->sex,
            'blood_type' => $request->blood_type,
            'updated_at' => now(),
        ];
        $dataEmployee = [
            'emp_id' => $request->emp_id,
            'hire_date' => $request->hire_date,
            'status' => $request->status,
            'updated_at' => now(),
        ];
        $dataSalary = [
            'salary' => $request->salary,
            'from_date' => $request->hire_date,
        ];
        $dataTitle = [
            'title' => $request->position,
            'from_date' => $request->hire_date
        ];
        $resultPerson = Person::where('id', '=', $employeeData->person_id)->update($dataPerson);
        $resultEmployee = Employee::where('emp_no', '=', $employeeData->emp_no)->update($dataEmployee);
        $resultSalary = Salary::where('id', '=', $id_salary)->update($dataSalary);
        $resultTitle = Title::where('id', '=', $id_title)->update($dataTitle);

        $log = [
            'user_id' => Auth::id(),
            'action' => 'Edit',
            'table_name' => 'Employee',
            'description' => 'Edit a employee',
            'ip_address' => request()->ip(),
            'created_at' => now(),
        ];
        $logData = Log::insert($log);

        if($resultEmployee && $resultPerson && $resultSalary && $resultTitle){
            return response()->json(['Error' => 0, 'Message' => 'Employee Information Successfully Updated']);
        }
    }
    public function removeEmployee(Request $request)
    {
        // employeeData->person_id
        // employeeData->emp_no
        $employeeData = Employee::where('emp_no', $request->id)
            ->whereNull('to_date')
            ->whereNull('deleted_at')
            ->first();

        // userData->id
        $userData = User::where('person_id', $employeeData->person_id)
            ->whereNull('deleted_at')
            ->first();

        // titleData->id
        $titleData = Title::where('emp_no', $request->id)
            ->whereNull('to_date')
            ->first();

        // salaryData->id
        $salaryData = Salary::where('emp_no', $request->id)
            ->whereNull('to_date')
            ->first();

        $employeeDepartmentData = DepartmentEmployee::where('emp_no', $employeeData->emp_no)
            ->whereNull('to_date')
            ->first();
        
        $dataUser = [
            'status_request' => 'Deleted',
            'deleted_at' => now()
        ];
        $dataEmployee = [
            'to_date' => now()->toDateString(),
            'status' => 'Remove',
            'deleted_at' => now(),
        ];
        $data = [
            'deleted_at' => now(),
        ];
        $dataDeptEmployee = [
            'status' => 'remove',
            'to_date' => now()->toDateString(),
            'updated_at' => now(),
        ];

        $dataSalaryAndTitle = [
            'to_date' => now()->toDateString(),
            'updated_at' => now()
        ];

        $resultPerson = Person::where('id', $employeeData->person_id)->update($data);
        $resultUser = User::where('id', $userData->id)->update($dataUser);
        $resultEmployee = Employee::where('emp_no',$employeeData->emp_no )->update($dataEmployee);
        $resultSalary = Salary::where('id', $salaryData->id)->update($dataSalaryAndTitle);
        $resultTitle = Title::where('id',$titleData->id)->update($dataSalaryAndTitle);
        $resultDepartmentEmployee = DepartmentEmployee::where('id_no', $employeeDepartmentData->id_no)->update($dataDeptEmployee);

        if($resultPerson && $resultEmployee && $resultUser && $resultDepartmentEmployee){
            return response()->json(['Error' => 0, 'Message' => 'Employee Successfully Deleted']);   
        }
    }
    public function registerFaceProcess(Request $request)
    {
        $data = [
            'face_descriptor' => $request->descriptor,
            'updated_at' => now()
        ];
        $result = Employee::where('emp_no', Crypt::decryptString($request->id))->update($data);

        if($result){
            return response()->json(['Error' => 0, 'Message' => 'Face successfully register']);
        } 
    }
    public function resetFaceID(Request $request)
    {
        $data = [
            'face_descriptor' => null,
            'updated_at' => now()
        ];
        $result = Employee::where('emp_no', Crypt::decryptString($request->id))->update($data);

        if(!$result){
            return response()->json(['Error' => 0, 'Message' => 'Face ID failed reset']);
        }

        return response()->json(['Error' => 0, 'Message' => 'Face ID successfully reset']);
    }
    public function employeeRaise(Request $request)
    {
        $isUpdate = false;
        $id = Crypt::decryptString($request->id);
        $salaryResult = Salary::where('emp_no', $id)->whereNull('to_date')
            ->where('salary', '!=', $request->salary)
            ->first();

        if(!empty($salaryResult)){
            $currentSalary = [
                'to_date' => now()->toDateString(),
                'updated_at' => now()
            ];
            
            $data = [
                'emp_no' => $id,
                'salary' => $request->salary,
                'from_date' => now()->toDateString(),
                'created_at' => now()
            ];

            Salary::where('id', $salaryResult->id)->update($currentSalary);
            Salary::insert($data);
            $isUpdate = true;
        }

        $titleResult = Title::where('emp_no', $id)->whereNull('to_date')
            ->where('title', '!=', $request->title)
            ->first();

        if(!empty($titleResult)){
            $currentTitle = [
                'to_date' => now()->toDateString(),
                'updated_at' => now()
            ];
            $data = [
                'emp_no' => $id,
                'title' => $request->title,
                'from_date' => now()->toDateString(),
                'created_at' => now()
            ];
            
            Title::where('id', $titleResult->id)->update($currentTitle);
            Title::insert($data);
            $isUpdate = true;
        }

        if($isUpdate){
            return response()->json(['Error' => 0, 'Message' => 'Changes saved successfully']);
        }
        return response()->json(['Error' => 0, 'Message' => 'No changes were made']);
    }
}

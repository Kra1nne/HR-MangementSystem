<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Person;
use App\Models\Salary;
use App\Models\Title;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class EmployeeController extends Controller
{
    public function index(Request $request){
        
        $data = Employee::with(['person', 'latestSalary', 'latestTitle']);

        if($request->search){
            $data->where('emp_id', 'like', '%'.$request->search.'%');
        }

        $employees = $data->whereNull('deleted_at')
            ->paginate(10);

        $employees->getCollection()->transform(function ($employee) {
            $employee->encrypted_id = Crypt::encryptString($employee->emp_no);
            return $employee;
        });
        
        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Employee'],
        ];
        return view('content.employee.employee', compact('breadcrumbs','employees'));
    }
    public function registerFace(){
        return view('content.employee.face-registration');
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
        ];
        $dataTitle = [
            'emp_no' => $employee->id,
            'title' => $request->position,
            'from_date' => $request->hire_date
        ];
        $title = Title::insert($dataTitle);
        $salary = Salary::insert($dataSalary);

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

        if($resultEmployee && $resultPerson && $resultSalary && $resultTitle){
            return response()->json(['Error' => 0, 'Message' => 'Employee Information Successfully Updated']);
        }
    }
}

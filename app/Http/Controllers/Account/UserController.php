<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Log;
use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(){
      $employees = Employee::leftJoin('person', 'person.id', '=', 'employees.person_id')
        ->whereNull('employees.deleted_at')
        ->whereNotIn('employees.person_id', function ($query) {
            $query->select('person_id')
                  ->from('users')
                  ->whereNull('deleted_at');
        })
        ->get();
      
      $breadcrumbs = [
          ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
          ['name' => 'Accounts'],
      ];
      $users = User::leftjoin('person', 'person.id', 'users.person_id')
        ->orderBy('users.id', 'DESC')
        ->whereNull('users.deleted_at')
        ->select('person.*', 'users.*','users.id as user_id')
        ->get();
        
      return view('content.accounts.users', compact('users', 'employees', 'breadcrumbs'));
    }
    public function store(Request $request){

    $otp = Str::upper(Str::random(6));

    $user = [
      'email' => $request->email,
      'password' => bcrypt($request->password),
      'role' => $request->role,
      'created_at' => now(),
      'person_id' => $request->person_id,
      'status_request' => "Done",
      'otp' => $otp,
    ];

    $userData = User::create($user);

    $log = [
      'user_id' => $userData->id,
      'action' => 'Add',
      'table_name' => 'Users',
      'description' => 'Added a account',
      'ip_address' => request()->ip(),
      'created_at' => now(),
    ];
    $logData = Log::insert($log);

    if($logData){
      return response()->json(['Error' => 0, 'Message' => 'Successfully added a data']);
    }
  }
  public function update(Request $request){
    $id =  Crypt::decryptString($request->id);
    $user = [
      'email' => $request->email,
      'role' => $request->role,
    ];
    
    User::where('id', $id)->update($user);
   
    $log = [
      'user_id' =>  Auth::id(),
      'action' => 'Update',
      'table_name' => 'Users',
      'description' => 'Update a account',
      'ip_address' => request()->ip(),
      'created_at' => now(),
    ];

    $logData = Log::insert($log);

    if($logData){
      return response()->json(['Error' => 0, 'Message' => 'Successfully update a data']);
    }
  }
  public function delete(Request $request){

    $id = Crypt::decryptString($request->id);

    $user = [
      'deleted_at' => now(),
      'status_request' => 'Deleted'
    ];

    $person = [
      'deleted_at' => now()
    ];

    $userData = User::where('id', $id)->update($user);
    $personData = Person::where('id', $id)->update($person);


    $log = [
      'user_id' =>  $id, //Auth::id()
      'action' => 'Update',
      'table_name' => 'Users',
      'description' => 'Update a account',
      'ip_address' => request()->ip(),
      'created_at' => now(),
    ];

    $logData = Log::insert($log);

    if($logData){
      return response()->json(['Error' => 0, 'Message' => 'Successfully delete a data']);
    }
  }
  public function decline(Request $request){
    $id = $request->id;

    $data = [
      'status_request' => 'Decline'
    ];
    User::where('id', $id)->update($data);

    $log = [
      'user_id' =>  $id, 
      'action' => 'Update',
      'table_name' => 'Users',
      'description' => 'Decline account request',
      'ip_address' => request()->ip(),
      'created_at' => now(),
    ];

    $logData = Log::insert($log);

    if($logData){
      return response()->json(['Error' => 0, 'Message' => 'Successfully decline the request']);
    }
  }
  public function accept(Request $request){
    $id = $request->id;

    $data = [
      'status_request' => 'Done'
    ];
    User::where('id', $id)->update($data);

    $log = [
      'user_id' =>  $id, 
      'action' => 'Update',
      'table_name' => 'Users',
      'description' => 'Accepted account request',
      'ip_address' => request()->ip(),
      'created_at' => now(),
    ];

    $logData = Log::insert($log);

    if($logData){
      return response()->json(['Error' => 0, 'Message' => 'Successfully accepted the request']);
    }
  }
   public function activation(Request $request){
    $id = $request->id;
    $password = $request->id;

    $data = [
      'status_request' => 'Active',
      'password' => bcrypt($password)
    ];
    User::where('id', $id)->update($data);

    $log = [
      'user_id' =>  $id, 
      'action' => 'Update',
      'table_name' => 'Users',
      'description' => 'Accepted account request',
      'ip_address' => request()->ip(),
      'created_at' => now(),
    ];

    $logData = Log::insert($log);

    if($logData){
      return response()->json(['Error' => 0, 'Message' => 'Successfully accepted the request']);
    }
  }
}

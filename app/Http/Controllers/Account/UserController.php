<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Mail\AccountMail;
use App\Models\Employee;
use App\Models\Log;
use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index(){
      $employees = Employee::leftJoin('persons', 'persons.id', '=', 'employees.person_id')
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
      $users = User::leftjoin('persons', 'persons.id', 'users.person_id')
        ->orderBy('users.id', 'DESC')
        ->whereNull('users.deleted_at')
        ->select('persons.*', 'users.*','users.id as user_id')
        ->get();
       
      return view('content.accounts.users', compact('users', 'employees', 'breadcrumbs'));
    }
    public function store(Request $request){

    $user = [
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'role' => $request->role,
      'created_at' => now(),
      'person_id' => $request->person_id,
      'status_request' => "Done",
    ];

    $personDetails = Person::whereNull('deleted_at')
      ->where('id', $request->person_id)
      ->first(); 
      
    $mailData = [
        'name' => $personDetails->firstname,
        'temporaryPassword' => $request->password,
        'loginUrl' => url('http://127.0.0.1:8000/login'),
        'email' => $request->email,
        'supportEmail' => 'hr@yourcompany.com',
    ];
    Mail::to($request->email)->send(new AccountMail($mailData));

    $userData = User::create($user);

    $log = [
      'user_id' => Auth::id(),
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

    $userData = User::where('id', $id)->update($user);


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
}

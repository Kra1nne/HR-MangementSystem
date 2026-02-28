<?php

namespace App\Http\Controllers\Account;

use App\Models\Log;
use App\Models\User;
use App\Models\Person;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    public function index(){
      $users = User::leftjoin('person', 'person.id', 'users.person_id')->orderBy('users.id', 'DESC')->whereNull('users.deleted_at')->get();
      return view('content.accounts.users', compact('users'));
    }
    public function store(Request $request){

    $person = [
      'firstname' => $request->firstname,
      'middlename' => $request->middlename,
      'lastname' => $request->lastname,
      'created_at' => now()
    ];

    $personData = Person::create($person);
    $user = [
      'email' => $request->email,
      'password' => bcrypt($request->password),
      'role' => $request->role,
      'created_at' => now(),
      'person_id' => $personData->id,
      'status_request' => "Done"
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

     $person = [
      'firstname' => $request->firstname,
      'middlename' => $request->middlename,
      'lastname' => $request->lastname,
      'created_at' => now()
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

<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;

class LoginBasic extends Controller
{
  public function index() : View
  {
    return view('content.authentications.auth-login-basic');
  }
  public function login(Request $request) : JsonResponse
  {
    $account = User::where('email', $request->email_username)->whereNull('deleted_at')->first();
    if (!$account || !Hash::check($request->password, $account->password)) {
        $message = $account ? 'Invalid Email or Password.' : 'Account didn\'t exist.';
        return response()->json(['Error' => 1, 'Message' => $message]);
    }

    if($account->status_request == "Done"){
      return response()->json(['Error' => 0, 'Message' => 'Successfully login', 'Redirect' => route('new-password', $account->id)]);
    }

    $logData = [
        'user_id' => $account->id,
        'action' => 'Login',
        'table_name' => 'Users',
        'description' => $account->firstname.' '.$account->lastname .' is Successfully login',
        'ip_address' => request()->ip(),
        'created_at' => now(),
      ];

      Log::insert($logData);
      Auth::login($account);      

      return response()->json(['Error' => 0, 'Message' => 'Successfully login', 'Redirect' => route('dashboard-analytics')]);
  }
  public function logoutAccount(Request $request) 
  {
    $account = User::where('id', Auth::id())->first();
    $logData = [
      'user_id' => Auth::id(),
      'action' => 'Logout',
      'table_name' => 'Users',
      'description' => $account->email.' is Successfully logout',
      'ip_address' => request()->ip(),
      'created_at' => now(),
    ];

    $resultLogs = Log::insert($logData);
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
  }
  public function newPassword(){
    return view('content.authentications.auth-new-password');
  }
}

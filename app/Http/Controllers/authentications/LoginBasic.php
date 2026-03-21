<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LoginBasic extends Controller
{
  public function index() : View
  {
    return view('content.authentications.auth-login-basic');
  }
  public function login(Request $request) : RedirectResponse
  {
    $account = User::where('email', $request->email_username)->whereNull('deleted_at')->first();
    if (!$account || !Hash::check($request->password, $account->password)) {
        $message = $account 
            ? 'Invalid Email or Password.' 
            : 'Account didn\'t exist.';

        return back()->withErrors([
            'login' => $message
        ])->withInput();
    }

    if ($account->status_request == "Done") {
        return redirect()->route('new-password', Crypt::encryptString($account->id))
            ->with('success', 'Please set your new password.');
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

      return redirect()->route('dashboard-analytics')->with('success', 'Successfully login');
  }
  public function logoutAccount(Request $request) : RedirectResponse
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
}

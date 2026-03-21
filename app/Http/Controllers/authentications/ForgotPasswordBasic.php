<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Mail\OTPMail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ForgotPasswordBasic extends Controller
{
  public function index() : View
  {
    return view('content.authentications.auth-forgot-password-basic');
  }
  public function viewOTP($id) : View
  {
    return view('content.authentications.otp', compact('id'));
  }
  public function sendOTP(Request $request) : RedirectResponse
  {
    $userData = User::with('person')
      ->where('email', $request->email)
      ->first();

    if (!$userData) {
        return back()->withErrors([
            'email' => 'Email not found in our records.'
        ])->withInput();
    }
    $otp = strtoupper(Str::random(6));
    $data = [
      'name' => $userData->person->firstname,
      'otp' => $otp,
      'expiryMinutes' => "20 mins"
    ];
    
    Mail::to($request->email)->send(new OTPMail($data));

    $data = [
      'otp' => $otp,
      'otp_validity' => now()->addMinutes(20)
    ];

    $result = User::where('id', $userData->id)->update($data);
    if(!$result){
      return back()->withErrors([
          'email' => 'Email not found in our records.'
      ])->withInput();
    }

    return redirect()->route('auth-request-otp', Crypt::encryptString($userData->id));
  }
  public function verifyOTP(Request $request) //: RedirectResponse
  {
    $otp = implode('', $request->otp);
    
    $result = User::whereNull('deleted_at')
      ->where('otp', $otp)
      ->where('id', Crypt::decryptString($request->id))
      ->first();
    
    if(!$result){
      return back()->withErrors([
        'otp' => 'The OTP you entered is incorrect.'
      ])->withInput();
    }
    if($result->otp_validity->isPast()){
        return back()->withErrors([
          'otp' => 'The OTP you entered is expired.'
        ])->withInput();
    }
    
    return redirect()->route('new-password', $request->id)
              ->with('success', 'Please set your new password.');
  }
}

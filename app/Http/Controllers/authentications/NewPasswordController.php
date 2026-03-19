<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class NewPasswordController extends Controller
{
    public function index($id){
        $data = User::where('id', $id)->whereNull('deleted_at')->first();
        return view('content.authentications.auth-new-password', compact('data'));
    }
    public function newAccount(Request $request){
        $data = [
            'password' => bcrypt($request->password),
            'updated_at' => now(),
            'email_verified_at' => now(),
            'status_request' => 'Active',
        ];

        $dataResult = User::where('id', $request->id)->update($data);

        return response()->json(['Error' => 0, 'Message' => 'Successfully change the password', 'Redirect' => route('login')]);
    }
}

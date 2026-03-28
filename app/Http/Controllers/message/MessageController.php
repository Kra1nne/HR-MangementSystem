<?php

namespace App\Http\Controllers\message;

use App\Http\Controllers\Controller;
use App\Mail\MessageMail;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function sendMessage(Request $request) 
    {
        if(empty($request->messageTitle) && empty($request->messageContent) && empty($request->id))
        {
            return response()->json(['Error' => 1, 'Message' => 'Invalid empty message']);   
        }
        $userData = Employee::leftjoin('persons', 'persons.id', '=', 'employees.person_id')
            ->leftjoin('users', 'users.person_id', '=', 'employees.person_id')
            ->where('employees.emp_no', $request->id)
            ->select('users.email', 'persons.firstname', 'persons.middlename', 'persons.lastname')
            ->first();
        $data = [
            'name' => $userData->firstname . " " . $userData->middlename . " " . $userData->lastname,
            'title' => $request->messageTitle,
            'description' => $request->messageContent
        ];
        
        $result = Mail::to($userData->email)->send(new MessageMail($data));

        if($result){
            return response()->json(['Error' => 0, 'Message' => 'Message successfully sent']);
        }
    }
    public function broadcastMessage(Request $request){
        $emails = Employee::leftjoin('users', 'users.person_id', 'employees.person_id')
            ->whereNull('employees.deleted_at')
            ->pluck('users.email') 
            ->toArray();

         $data = [
            'name' => 'Employee',
            'title' => $request->messageTitle,
            'description' => $request->messageContent
        ];
        
        try {
            Mail::bcc($emails)->send(new MessageMail($data));

            return response()->json([
                'Error' => 0,
                'Message' => 'Message successfully sent'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'Error' => 1,
                'Message' => 'Failed to send message',
                'Details' => $e->getMessage()
            ]);
        }
        return response()->json(['Error' => 0, 'Message' => 'Message successfully sent']);
    }
    public function broadcastMessageDepartment(Request $request)
    {
        return response()->json(['Error' => 0, 'Message' => 'Message successfully sent']);
    }
}

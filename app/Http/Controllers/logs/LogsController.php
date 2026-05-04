<?php

namespace App\Http\Controllers\logs;

use App\Http\Controllers\Controller;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LogsController extends Controller
{
    public function index(Request $request) : View
    {
        $isSearch = false;
        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Accounts'],
        ];

        $data = Log::with('user.person')->orderBy('id', 'desc');

        if($request->search){
            $isSearch = true;
            $data->where('table_name', 'like',  '%'.$request->search.'%');
        }

        $logsData = $data->paginate(10);
            
        return view('content.logs-activity.logs', compact('breadcrumbs', 'logsData', 'isSearch'));
    }
}

<?php

namespace App\Http\Controllers\logs;

use App\Http\Controllers\Controller;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LogsController extends Controller
{
    public function index() : View
    {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Accounts'],
        ];
        $logsData = Log::with('user')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('content.logs-activity.logs', compact('breadcrumbs', 'logsData'));
    }
}

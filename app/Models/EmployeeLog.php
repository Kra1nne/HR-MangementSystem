<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeLog extends Model
{
    protected $table = "employee_logs";

    protected $fillable = [
        'dept_employee_id',
        'log_type',
        'time',
        'date',
        'row_number',
        'remarks'
    ];
}

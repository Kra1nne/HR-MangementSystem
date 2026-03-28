<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeLog extends Model
{
    protected $table = "employee_logs";

    protected $fillable = [
        'dept_employee_id',
        'row',
        'time',
        'date',
        'remarks'
    ];

    protected $casts = [
        'time' => 'datetime',
        'date' => 'date'
    ];

    public function employee(){
        return $this->belongsTo(DepartmentEmployee::class, 'dept_employee_id', 'id_no');
    }
}

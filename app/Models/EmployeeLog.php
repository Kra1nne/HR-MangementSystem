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
        'remarks',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'date' => 'date:Y-m-d',
        'time' => 'string', 
    ];

    public function employee(){
        return $this->belongsTo(DepartmentEmployee::class, 'dept_employee_id', 'id_no');
    }
}

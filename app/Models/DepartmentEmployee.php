<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartmentEmployee extends Model
{
    protected $table = 'department_employees';

    protected $fillable = [
        'id_no',
        'emp_no',
        'dept_no',
        'status',
        'from_date',
        'to_date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_no', 'emp_no');
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_no', 'dept_no');
    }
    public function employee_logs()
    {
        return $this->hasMany(EmployeeLog::class, 'dept_employee_id', 'id_no');
    }
}

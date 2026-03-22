<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartmentManager extends Model
{
    protected $table = 'department_managers';

    protected $fillable = [
        'emp_no',
        'dept_no',
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
}

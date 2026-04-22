<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeHistory extends Model
{
    protected $table = 'employment_histories';

    protected $fillable = [
        'emp_no',
        'company',
        'position',
        'salary',
        'description',
        'start_date', 
        'to_date'
    ];

    public function employee(){
        return $this->belongsTo(Employee::class, 'emp_no', 'emp_no');
    }
}

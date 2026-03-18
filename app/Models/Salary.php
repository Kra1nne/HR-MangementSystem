<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $table = 'salaries';

    protected $fillable = [
        'id',
        'emp_no',
        'salary',
        'from_date',
        'to_date',
    ];

    public function employee(){
        return $this->belongsTo(Employee::class, 'emp_no', 'emp_no');
    }
}

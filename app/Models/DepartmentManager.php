<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartmentManager extends Model
{
    protected $table = 'dept_manager';

    protected $fillable = [
        'emp_no',
        'dept_no',
        'from_date',
        'to_date',
    ];
}

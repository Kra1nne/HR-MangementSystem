<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartmentEmployee extends Model
{
    protected $table = 'employees';

    protected $fillable = [
        'emp_no',
        'users_id',
        'hire_date',
        'status',
    ];
}

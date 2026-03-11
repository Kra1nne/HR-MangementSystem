<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartmentEmployee extends Model
{
    protected $table = 'dept_emp';

    protected $fillable = [
        'id_no',
        'emp_no',
        'dept_no',
        'users_id',
        'from_date',
        'to_date',
    ];
}

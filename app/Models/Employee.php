<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = "employees";
    
    protected $fillable = [
        'emp_no',
        'users_id',
        'hire_date',
        'status_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}

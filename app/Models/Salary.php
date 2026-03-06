<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $table = 'salaries';

    protected $fillable = [
        'emp_no',
        'salary',
        'from_date',
        'to_date',
    ];
}

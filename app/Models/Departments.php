<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    protected $table = "departments";

    protected $fillable = [
        'dept_no',
        'dept_name',
        'details',
        'icon',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
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

    public function department_managers()
    {
        return $this->hasMany(DepartmentManager::class, 'dept_no', 'dept_no');
    }
    public function department_employess()
    {
        return $this->hasMany(DepartmentEmployee::class, 'dept_no', 'dept_no');
    }
}

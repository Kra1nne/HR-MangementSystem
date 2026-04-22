<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    protected $table = "departments";
    use SoftDeletes;

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
    public function latestManager()
    {
        return $this->hasOne(DepartmentManager::class, 'dept_no', 'dept_no')
                    ->whereNull('to_date')
                    ->orderByDesc('from_date');
    }
    public function department_employees()
    {
        return $this->hasMany(DepartmentEmployee::class, 'dept_no', 'dept_no');
    }
    public function jobs()
    {
        return $this->hasMany(JobPosting::class, 'dept_no', 'dept_no');
    }
}

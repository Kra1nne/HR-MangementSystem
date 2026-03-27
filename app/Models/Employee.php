<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use function PHPUnit\Framework\matches;

class Employee extends Model
{
    protected $table = "employees";
    use SoftDeletes;
    protected $fillable = [
        'emp_no',
        'person_id',
        'emp_id',
        'hire_date',
        'status',
        'face_descriptor',
        'salary',
        'created_at',
        'updated_at',
    ];

    public function person(){
        return $this->belongsTo(Person::class, 'person_id', 'id');
    }
    public function salaries(){
        return $this->hasMany(Salary::class, 'emp_no', 'emp_no');
    }
    public function titles(){
        return $this->hasMany(Title::class, 'emp_no', 'emp_no');
    }
    public function latestTitle()
    {
        return $this->hasOne(Title::class, 'emp_no', 'emp_no')
                    ->orderByDesc('from_date');
    }
    public function latestSalary()
    {
        return $this->hasOne(Salary::class, 'emp_no', 'emp_no')
                    ->orderByDesc('from_date');
    }
    public function EmployeeBadge(): string
    {
        return match($this->status){
            'Contractual' => 'badge bg-success',
            'Regular' => 'badge bg-primary',
            'Probationary' => 'badge bg-warning',
            default => 'badge bg-secondary'
        };
    }
}

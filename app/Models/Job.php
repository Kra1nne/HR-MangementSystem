<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'job';

    protected $fillable = [
        'title',
        'description',
        'position',
        'salary_range',
        'job_objective',
        'job_requirements',
    ];
}

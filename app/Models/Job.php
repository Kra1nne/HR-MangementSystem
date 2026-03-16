<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'jobs';

    protected $fillable = [
        'id',
        'title',
        'description',
        'position',
        'salary_range',
        'job_objective',
        'job_requirements',
        'active_date',
        'work_arrangement',
        'job_type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'active_date' => 'date',
    ];

    public function candidates(){
        return $this->hasMany(Candidate::class, 'job_id', 'id');
    }
}

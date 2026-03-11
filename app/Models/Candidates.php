<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidates extends Model
{
    protected $table = 'candidates';

    protected $fillable = [
        'id',
        'job_id',
        'person_id',
        'status',
        'exam',
        'exam_status',
        'interview',
        'interview_status',
        'email',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}

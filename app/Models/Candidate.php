<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
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
    public function job(){
        return $this->hasOne(Job::class, 'job_id', 'id');
    }
    public function person(){
        return $this->belongsTo(Person::class, 'person_id', 'id');
    }

    public function GetstatusBadge() : string
    {
        return match($this->status) {
            'Completed'   => 'badge bg-success text-white',
            'In Progress' => 'badge bg-primary text-white',
            'Rejected'    => 'badge bg-danger text-white',
             default      => 'badge bg-warning text-white',
        };
    }
}

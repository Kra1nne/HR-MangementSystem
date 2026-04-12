<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = 'applications';

    protected $fillable = [
        'job_id',
        'status',
        'applied_at',
        'created_at',
        'updated_at'
    ];

    public function candidate()
    {
        return $this->hasOne(Candidate::class, 'application_id', 'id');
    }
    public function applicationDocuments()
    {
        return $this->hasMany(ApplicationDocument::class, 'application_id', 'id');
    }
    public function applicationLogs()
    {
        return $this->hasMany(ApplicationLog::class, 'application_id', 'id');
    }
    public function jobposting()
    {
        return $this->belonsTo(JobPosting::class, 'job_id', 'id');
    }
}

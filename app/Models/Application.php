<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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
    public function latestApplicationLogs()
    {
        return $this->hasOne(ApplicationLog::class, 'application_id', 'id')
            ->orderByDesc('created_at');
    }
    public function jobposting()
    {
        return $this->belongsTo(JobPosting::class, 'job_id', 'id');
    }
    public function statusBadge(): string
    {
        return match($this->status) {
            'accepted' => 'badge bg-label-success',
            'apply' => 'badge bg-label-primary',
            'shortlist' => 'badge bg-label-info',
            default => 'badge bg-label-danger'
        };
    }
}

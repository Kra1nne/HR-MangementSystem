<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class JobPosting extends Model
{
    protected $table = 'job_postings';

    protected $fillable = [
        'dept_no',
        'created_by',
        'job_title',
        'description',
        'objectives',
        'requirements',
        'salary',
        'position',
        'employment_type',
        'work_setup',
        'location',
        'status',
        'posted_at',
        'closing_date',
    ];

    protected $casts = [
        'closing_date' => 'datetime',
        'posted_at' => 'datetime',
    ];
    public function getEncryptedIdAttribute()
    {
        return Crypt::encryptString($this->id);
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_no', 'dept_no');
    }
}

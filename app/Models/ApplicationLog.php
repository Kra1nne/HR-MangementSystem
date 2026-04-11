<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationLog extends Model
{
    protected $table = 'application_logs';

    protected $fillable = [
        'application_id',
        'event_type',
        'stage',
        'status',
        'score',
        'rating',
        'scheduled_at',
        'remarks'
    ];

    public function application()
    {
        return $this->belongsTo(Application::class, 'application_id', 'id');
    }
}

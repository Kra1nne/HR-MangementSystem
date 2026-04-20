<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class ApplicationLog extends Model
{
    protected $table = 'application_logs';

    protected $fillable = [
        'application_id',
        'event_type',
        'scheduled_at',
        'assessment_tools',
        'remarks',
        'status',
        'score',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class, 'application_id', 'id');
    }

    public function remarksBadge(): Attribute
    {
        return Attribute::make(
        get: fn () => match($this->remarks) {
            'pass' => 'badge bg-success',
            'fail' => 'badge bg-danger',
            default => 'badge bg-primary',
            null => 'badge bg-primary'
        }
        );
    }
}

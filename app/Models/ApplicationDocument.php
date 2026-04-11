<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationDocument extends Model
{
    protected $table = 'application_documents';

    protected $fillable = [
        'application_id',
        'type',
        'file_path',
        'created_at',
        'updated_at'
    ];

    public function application()
    {
        return $this->belongsTo(Application::class, 'application_id', 'id');
    }
}

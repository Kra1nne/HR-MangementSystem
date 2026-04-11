<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $table = 'candidates';

    protected $fillable = [
        'application_id',
        'person_id',
        'created_at',
        'updated_at'
    ];

    public function person()
    {
      return $this->belongsTo(Person::class, 'person_id', 'id');
    }
    public function application()
    {
        return $this->belongsTo(Application::class, 'application_id', 'id');
    }
}

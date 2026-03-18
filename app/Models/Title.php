<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    protected $table = 'titles';

    protected $fillable = [
        'id',
        'emp_no',
        'title',
        'from_date',
        'to_date',
    ];

    public function employee(){
        return $this->belongsTo(Employee::class, 'emp_no', 'emp_no');
    }
}

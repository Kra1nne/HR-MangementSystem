<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    protected $table = 'titles';

    protected $fillable = [
        'emp_no',
        'title',
        'from_date',
        'to_date',
    ];
}

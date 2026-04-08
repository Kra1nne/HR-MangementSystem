<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'persons';

    protected $fillable = [
      'id',
      'firstname',
      'middlename',
      'lastname',
      'address',
      'phone_number',
      'birth_date',
      'sex',
      'blood_type',
      'created_at',
      'updated_at',
      'deleted_at'
    ];
    protected $appends = [
      'full_name'
    ];

    public function employee()
    {
      return $this->hasOne(Employee::class, 'person_id', 'id');
    }
    public function user()
    {
      return $this->hasOne(User::class, 'person_id', 'id');
    }
    protected function fullName(): Attribute
    {
      return Attribute::make(
          get: fn () => trim(implode(' ', array_filter([
              $this->firstname,
              $this->middlename,
              $this->lastname,
          ])))
      );
    }
}

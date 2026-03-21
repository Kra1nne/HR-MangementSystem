<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable implements MustVerifyEmail
{
  use Notifiable;
  protected $table = 'users';
  protected $fillable = [
    'id',
    'email',
    'password',
    'role',
    'created_at',
    'deleted_at',
    'updated_at',
    'person_id',
    'email_verified_at',
    'status_request',
    'otp',
    'otp_validity'
  ];
  protected $casts = [
    'otp_validity' => 'date'
  ];
  public function person()
  {
    return $this->belongsTo(Person::class, 'person_id');
  }

  public function getStatus(): string
  {
    return match($this->status_request) {
      'Active' => 'bg-label-success',
      'Done' => 'bg-label-primary',
      'Deleted' => 'bg-label-warning',
      default => 'bg-label-secondary'
    };
  }
}
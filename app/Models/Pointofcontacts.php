<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pointofcontacts extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'point_of_contacts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'related_id', 'first_name', 'last_name', 'designation', 'working_phone', 'personal_phone', 'email', 'comments', 'status'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property string $name
 * @property UserPhone $phones
 * @property UserEmail $emails

 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function phones(): HasMany
    {
        return $this->hasMany(UserPhone::class);
    }

    public function emails(): HasMany
    {
        return $this->hasMany(UserEmail::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['email', 'password', 'is_admin'];

    protected $hidden = ['password', 'remember_token'];

    public function userMeta()
    {
        return $this->hasOne(UserMeta::class);
    }
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'id_utente');
    }
}

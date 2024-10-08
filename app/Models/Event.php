<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $guarded = [];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'evento_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

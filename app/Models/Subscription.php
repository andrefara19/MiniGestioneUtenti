<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'subscriptions';

    protected $guarded = [];

    public function guests()
    {
        return $this->hasMany(Guest::class); //subscription_id
    }
    public function user()
    {
        return $this->belongsTo(User::class); //user_id
    }
    public function event()
    {
        return $this->belongsTo(Event::class, 'evento_id');
    }
    


}

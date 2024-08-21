<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'subscriptions';

    protected $fillable = [
        'user_id',
        'evento_id',
        'nome',
        'cognome',
        'email',
        'cellulare',
        'accompagnatori',
        'presenze',
        'pagato',
    ];

    public function guests()
    {
        return $this->hasMany(Guest::class); //subscription_id
    }
    public function users()
    {
        return $this->belongsTo(User::class); //user_id
    }
    public function events()
    {
        return $this->belongsTo(Event::class, 'evento_id');
    }
    


}

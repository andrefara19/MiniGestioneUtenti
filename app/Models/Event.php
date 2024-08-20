<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $fillable = [
        'titolo',
        'luogo',
        'indirizzo',
        'comune',
        'provincia',
        'data_inizio',
        'data_fine',
        'posti',
        'ospiti',
        'gratuito',
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'id_evento');
    }
}

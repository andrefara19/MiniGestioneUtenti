<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $fillable = [
        'user_id',
        'nome',
        'cognome',
        'indirizzo',
        'cap',
        'citta',
        'provincia',
        'nazione_id',
        'cellulare',
    ]
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    use HasFactory;

    protected $table = 'user_meta'; 

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
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'nazione_id');
    }
}

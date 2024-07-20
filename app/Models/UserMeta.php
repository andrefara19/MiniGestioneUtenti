<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'nome', 'cognome', 'indirizzo', 'cap', 'citta', 'provincia', 'nazione_id'];

    protected $table = 'user_meta';  // Assicurati che il nome della tabella sia corretto

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function nazione()
    {
        return $this->belongsTo(Country::class, 'nazione_id');
    }
}

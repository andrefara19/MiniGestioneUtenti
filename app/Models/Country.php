<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function userMetas()
    {
        return $this->hasMany(UserMeta::class, 'nazione_id');
    }
}
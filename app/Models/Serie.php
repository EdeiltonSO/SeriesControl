<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    // public $timestamps = false;
    protected $fillable = ['nome']; // relacionado ao banco

    public function temporadas()
    {
        return $this->hasMany(Temporada::class);
    }
}

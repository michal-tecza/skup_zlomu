<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oddzial extends Model
{
    protected $table = 'oddzialy';
    protected $primaryKey = 'id_oddzial';
    public $timestamps = false;

    public function transakcje()
    {
        return $this->hasMany(Transakcja::class, 'id_oddzial');
    }
    public function kierownik()
    {
        return $this->belongsTo(Pracownik::class, 'id_kierownik');
    }
}

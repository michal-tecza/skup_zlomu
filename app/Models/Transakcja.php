<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transakcja extends Model
{
    protected $table = 'transakcje';
    protected $primaryKey = 'id_transakcja';
    public $timestamps = false;

    public function metale()
    {
        return $this->belongsTo(Metal::class, 'id_metal');
    }
    public function klienci()
    {
        return $this->belongsTo(Klient::class, 'id_klient');
    }
    public function pracownicy()
    {
        return $this->belongsTo(Pracownik::class, 'id_pracownik');
    }
    public function oddzialy()
    {
        return $this->belongsTo(Oddzial::class, 'id_oddzial');
    }
}

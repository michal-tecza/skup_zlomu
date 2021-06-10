<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pracownik extends Model
{
    protected $table = 'pracownicy';
    protected $primaryKey = 'id_pracownik';
    public $timestamps = false;

    public function transakcje()
    {
        return $this->hasMany(Transakcja::class, 'id_pracownik');
    }
    public function oddzial()
    {
        return $this->hasMany(Oddzial::class, 'id_pracownik');
    }
}

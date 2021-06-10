<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klient extends Model
{
    protected $table = 'klienci';
    protected $primaryKey = 'id_klient';
    public $timestamps = false;

    public function transakcje()
    {
        return $this->hasMany(Transakcja::class, 'id_klient');
    }
}

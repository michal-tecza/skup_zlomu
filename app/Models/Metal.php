<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metal extends Model
{
    protected $table = 'metale';
    protected $primaryKey = 'id_metal';
    public $timestamps = false;

    public function transakcje()
    {
        return $this->hasMany(Transakcja::class, 'id_metal');
    }
}

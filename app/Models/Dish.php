<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $table = 'dishes'; // Tentukan nama tabel secara eksplisit
    protected $primaryKey = 'd_id'; // Tentukan kolom primary key

    // Relasi ke Restaurant
    public function restaurants()
    {
        return $this->belongsTo(Restaurant::class, 'rs_id');
    }
}

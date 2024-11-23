<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $table = 'restaurant';
    protected $primaryKey = 'rs_id'; // Tentukan kolom primary key

    // Relasi ke ResCategory
    public function category()
    {
        return $this->belongsTo(ResCategory::class, 'c_id');
    }

    // Relasi ke Restaurant
    public function dishes()
    {
        return $this->hasMany(Dish::class, 'rs_id');
    }
}

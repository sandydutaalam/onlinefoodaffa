<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResCategory extends Model
{
    protected $table = 'res_category'; // Tentukan nama tabel secara eksplisit
    protected $primaryKey = 'c_id'; // Tentukan kolom primary key

    // Nonaktifkan timestamps default
    public $timestamps = false;

    // Jika ingin menggunakan kolom date, tambahkan dalam fillable atau guarded
    protected $fillable = ['c_name', 'date'];

    // Relasi ke Restaurant
    public function restaurants()
    {
        return $this->hasMany(Restaurant::class, 'c_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    protected $table = 'users_orders';
    protected $primaryKey = 'o_id';
}

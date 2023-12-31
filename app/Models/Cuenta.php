<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;


class Cuenta extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    public function productos()
    {
        return $this->hasMany(Producto::class, 'cuenta_id');
    }
}

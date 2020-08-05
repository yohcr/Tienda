<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detalle_venta extends Model
{
    protected $fillable = ['producto_id','cantidad','subtotal','venta_id'];
}

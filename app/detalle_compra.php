<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detalle_compra extends Model
{
    protected $fillable = ['producto_id','cantidad','subtotal','compra_id'];
}

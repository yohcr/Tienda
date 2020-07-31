<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];
    protected $fillable = ['codigo', 'nombre_producto', 'presentacion','presentacion_2', 'proveedor_id', 'categoria', 'precio', 'existencias'];
}

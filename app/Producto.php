<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['codigo', 'nombre_producto', 'presentacion', 'proveedor_id', 'categoria', 'precio', 'existencias'];
}

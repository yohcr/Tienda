<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $fillable = ['total','idproveedor','estado','fechaapagar','archivo'];
}

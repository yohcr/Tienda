<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $fillable = ['nombre_proveedor','empresa','telefono'];
}

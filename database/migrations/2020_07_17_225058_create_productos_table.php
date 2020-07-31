<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo');
            $table->string('nombre_producto');
            $table->string('presentacion');
            $table->string('presentacion_2');
            $table->integer('proveedor_id')->unsigned();
            $table->string('categoria');
            $table->double('precio', 8, 2);
            $table->integer('existencias');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('proveedor_id')->references('id')->on('proveedors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}

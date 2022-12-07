<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('nombreProducto',50);
            $table->string('cantidad',50);
            $table->unsignedBigInteger('id_marcas')->nullable();
            $table->foreign('id_marcas')->references('id')->on('marcas');
            $table->unsignedBigInteger('id_proveedors')->nullable();
            $table->foreign('id_proveedors')->references('id')->on('proveedors');
            $table->timestamps();
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

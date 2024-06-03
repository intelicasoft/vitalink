<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_accesories', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->Integer('lote_id')->nullable();
            $table->Integer('proveedor_id')->nullable();
            $table->string('catalogo')->nullable();
            $table->integer('inventario')->nullable();
            $table->integer('costo')->nullable();
            $table->string('observaciones')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Agrega el campo para soft deletes


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_accesories');
    }
};

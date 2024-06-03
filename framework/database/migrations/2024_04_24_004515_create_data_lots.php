<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use League\CommonMark\Node\Query\ExpressionInterface;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_lots', function (Blueprint $table) {
            $table->id();
            $table->string('nlote');
            $table->string('nivel');
            $table->Integer('marca_id')->nullable();
            $table->string('observaciones')->nullable();
            //fechas
            $table->date('fabricacion')->nullable();
            $table->date('expiracion')->nullable();
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
        Schema::dropIfExists('data_lots');
    }
};

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
        Schema::create('data_zones', function (Blueprint $table) {
            $table->id();
            $table->integer('status')->nullable();
            $table->string('zone');
            $table->string('name')->nullable();
            $table->string('manager_email')->nullable();
            $table->integer('client_id')->nullable();
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
        Schema::dropIfExists('data_zones');
    }
};

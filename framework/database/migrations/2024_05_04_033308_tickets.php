<?php

use Hamcrest\Description;
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
        // schema para la tabla trazability_tickets
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->integer('status')->nullable();
            $table->string('description')->nullable();
            //title
            $table->string('title')->nullable();
            //failure   
            $table->string('model')->nullable();
            $table->string('failure')->nullable();
            $table->integer('manager_id')->nullable();
            //category
            $table->string('category')->nullable();
            //priority
            $table->integer('priority')->nullable();
            //adress
            $table->string('adress')->nullable();
            //lab_name
            $table->string('lab_name')->nullable();
            //phone
            $table->string('phone')->nullable();
            //extension
            $table->string('extension')->nullable();
            //contact
            $table->string('contact')->nullable();
            //equipment_id
            $table->integer('equipment_id')->nullable();
            //images
            $table->string('images')->nullable();
            //number_id
            $table->integer('number_id')->nullable();
            //user_id
            $table->integer('user_id')->nullable();
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

        Schema::dropIfExists('tickets');
    }
};

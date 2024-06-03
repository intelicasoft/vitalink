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
        // schema para la tabla trazability_serviceoirders
        Schema::create('service_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('status')->nullable();

            $table->text('user_sign')->nullable();

            $table->text('specialist_sign')->nullable();
            //send_emails
            $table->string('send_emails')->nullable();
            //client_id
            $table->integer('user_id')->nullable();
            $table->integer('ticket_id')->nullable();
            //images
            $table->string('images')->nullable();
            //maintenance_id
            $table->integer('maintenance_id')->nullable();
            //pdf
            $table->string('pdf')->nullable();
            //number_id
            $table->integer('number_id')->nullable();
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
            
        Schema::dropIfExists('service_orders');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('city');
            $table->string('nit');
            $table->integer('no_rooms');
            $table->text('room_type')->nullable();;
            $table->text('accommodation')->nullable();;
            // $table->enum('room_type', ['Standard', 'Junior', 'Suite']);
            // $table->enum('accommodation', ['Single', 'Double', 'Triple', 'Quadruple']);
            // // Agregar restricciones CHECK para tipos de habitación y acomodaciones
            // $table->checkConstraint('room_type IN (\'Standard\', \'Junior\', \'Suite\')');
            // $table->checkConstraint('accommodation IN (\'Single\', \'Double\', \'Triple\', \'Quadruple\')');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};

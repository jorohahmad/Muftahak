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
        Schema::create('waitings', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('apartment_id');
            $table->string('rented_id');
            $table->date('first_date');
            $table->date('last_date');
            $table->string('location');
            $table->string('id_credit_card');
            $table->string('state')->default('temporary');
            $table->string('confirmed')->default('false');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waitings');
    }
};

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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rented_id')->constrained('renteds')->cascadeOnDelete();
            $table->string('title');
            $table->string('governorate');
            $table->string('city');
            $table->integer('price');
            $table->string('description');
            $table->string('details');
            $table->double('rate')->default(0.0);
            $table->enum('status', ['Available', 'notAvailable'])->default('Available');
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('image4')->nullable();
            $table->string('image5')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartments');
    }
};

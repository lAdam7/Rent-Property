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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('name');
            $table->boolean('approved')->default(false);
            $table->string('street');
            $table->string('town_or_city');
            $table->timestamp('available');
            $table->integer('deposit');
            $table->integer('price');
            $table->string('min_tenancy');
            $table->boolean('furnished');
            $table->foreignId('property_type_id');
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->boolean('garden');
            $table->boolean('parking');
            $table->text('body');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};

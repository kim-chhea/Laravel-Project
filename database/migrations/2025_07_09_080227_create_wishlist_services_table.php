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
        Schema::create('wishlist_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wishlist_id');
            $table->unsignedBigInteger('service_id');
            $table->foreign('wishlist_id')->references('id')->on('wishlists')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('service_id')->references('id')->on('services')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlist_serivces');
    }
};

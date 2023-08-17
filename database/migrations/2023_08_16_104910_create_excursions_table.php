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
        Schema::create('excursions', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->date("time")->nullable();
            $table->foreignId('driver_id')->nullable()->constrained('drivers')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('bus_id')->nullable()->constrained('wagons')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('line_id')->nullable()->constrained('lines')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("note")->nullable()->default(" ");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('excursions');
    }
};

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
        Schema::create('fight_fighter', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Fighter::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Fight::class)->constrained()->cascadeOnDelete();
            $table->string('result')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fight_fighter');
    }
};

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
        Schema::create('fighters', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained()->cascadeOnDelete();
            $table->integer('strength')->default(0);
            $table->integer('agility')->default(0);
            $table->integer('stamina')->default(0);
            $table->integer('balance')->default(5000);
            $table->integer('height');
            $table->integer('weight');
            $table->foreignIdFor(\App\Models\WeightDivision::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\MartialArtStyle::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fighters');
    }
};

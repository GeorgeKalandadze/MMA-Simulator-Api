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
        Schema::create('fights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fighter1_id')->constrained('fighters')->onDelete('cascade');
            $table->foreignId('fighter2_id')->constrained('fighters')->onDelete('cascade');
            $table->foreignId('winner_id')->nullable()->constrained('fighters')->onDelete('set null');
            $table->date('fight_date');
            $table->string('location')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fights');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('fighter_skill', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Fighter::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Skill::class)->constrained()->cascadeOnDelete();
            $table->tinyInteger('level')->default(1)->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fighter_skill');
    }
};

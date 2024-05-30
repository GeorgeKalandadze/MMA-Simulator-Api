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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Fighter::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Sponsor::class)->constrained()->cascadeOnDelete();
            $table->decimal('amount', 10, 2);
            $table->integer('duration')->default(12);
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['pending', 'active', 'rejected', 'expired', 'terminated'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};

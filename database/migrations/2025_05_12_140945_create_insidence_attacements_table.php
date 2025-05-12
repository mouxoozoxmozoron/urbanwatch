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
        Schema::create('insidence_attacements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('incidence_id')->constrained('incidences')->cascadeOnDelete();
            $table->foreignId('type')->nullable()->constrained('attachement_types')->nullOnDelete();
            $table->string('attachement');
            $table->integer('status')->default(1);
            $table->integer('archive')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insidence_attacements');
    }
};

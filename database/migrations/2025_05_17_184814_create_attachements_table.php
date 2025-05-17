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
        Schema::create('attachements', function (Blueprint $table) {
            $table->id();
            $table->string('file');
            $table->foreignId('incidence_id')->constrained('incidences')->cascadeOnDelete();
            $table->foreignId('incidence_status')->nullable()->constrained('attachement_types')->nullOnDelete();
            $table->timestamps();
            $table->integer('status')->default(1);
            $table->integer('archive')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachements');
    }
};

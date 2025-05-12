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
        Schema::create('incidences', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('tittle');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('user_name');
            $table->string('phone');
            $table->string('region');
            $table->string('district');
            $table->string('ward');
            $table->timestamps();
            $table->integer('archive')->default(0);
            $table->integer('status')->default(1);
            $table->foreignId('resolve_status')->nullable()->constrained('incidence_statuses')->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidences');
    }
};

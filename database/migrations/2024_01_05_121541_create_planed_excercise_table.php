<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('planed_excercise', function (Blueprint $table) {
            $table->id();
            $table->timestamp('Duration')->nullable();
            $table->integer('repeat_count')->nullable();
            $table->integer('cycle_repetitions');
            $table->foreignId('excercise_id')->nullable()->constrained()->cascadeOnDelete;
            // $table->foreign('monthly_plan_id')->references('id')->on('monthly_plan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planed_excercise');
    }
};

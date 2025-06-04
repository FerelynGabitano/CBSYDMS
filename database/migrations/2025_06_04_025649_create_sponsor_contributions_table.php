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
        Schema::create('sponsor_contributions', function (Blueprint $table) {
            $table->id('contribution_id');
            $table->foreignId('sponsor_id')->constrained('sponsors');
            $table->foreignId('activity_id')->nullable()->constrained('activities');
            $table->decimal('amount', 10, 2);
            $table->string('contribution_type', 100);
            $table->text('description')->nullable();
            $table->dateTime('contributed_at');
            $table->foreignId('recorded_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sponsor_contributions');
    }
};

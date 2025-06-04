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
        Schema::create('activities', function (Blueprint $table) {
            $table->id('activity_id');
            $table->string('title', 100);
            $table->text('description')->nullable();
            $table->foreignId('category_id')->constrained('activity_categories', 'category_id');
            $table->dateTime('start_datetime');
            $table->dateTime('end_datetime');
            $table->string('location', 255);
            $table->integer('max_participants')->nullable();
            $table->foreignId('created_by')->constrained('users', 'user_id');
            $table->string('qr_code_path', 255)->nullable();
            $table->dateTime('qr_code_expiry')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};

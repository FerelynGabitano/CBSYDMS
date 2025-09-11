<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            // ✅ Drop foreign key first
            $table->dropForeign(['category_id']);

            // ✅ Then drop the columns
            $table->dropColumn(['category_id', 'qr_code_path', 'qr_code_expiry']);
        });
    }

    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            // Recreate columns if rolled back
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('qr_code_path')->nullable();
            $table->timestamp('qr_code_expiry')->nullable();

            // Recreate foreign key (adjust table name if different)
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }
};

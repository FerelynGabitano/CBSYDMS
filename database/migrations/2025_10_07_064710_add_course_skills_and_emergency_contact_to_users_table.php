<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('course')->nullable()->after('gradeLevel');
            $table->string('skills')->nullable()->after('course');
            $table->string('emergency_contact_no')->nullable()->after('skills');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['course', 'skills', 'emergency_contact_no']);
        });
    }
};


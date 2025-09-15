<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('brgyCert')->nullable();
            $table->string('birthCert')->nullable();
            $table->string('gradeReport')->nullable();
            $table->string('idPicture')->nullable();
            $table->string('cor')->nullable();
            $table->string('votersCert')->nullable();
            $table->string('bacthNo')->nullable();
            $table->string('brgyName')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['brgyCert', 'birthCert', 'gradeReport', 'idPicture', 'idPicture', 'cor', 'votersCert', 'bacthNo', 'brgyName']);
        });
    }
};

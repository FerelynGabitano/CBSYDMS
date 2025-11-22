<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'street_address',
                'barangay',
                'city_municipality',
                'province',
                'zip_code',
                'brgyCert',
                'birthCert',
                'gradeReport',
                'idPicture',
                'cor',
                'votersCert',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Add address columns
            $table->string('street_address');
            $table->string('barangay');
            $table->string('city_municipality');
            $table->string('province');
            $table->string('zip_code');

            // Add document columns
            $table->string('brgyCert')->nullable();
            $table->string('birthCert')->nullable();
            $table->string('gradeReport')->nullable();
            $table->string('idPicture')->nullable();
            $table->string('cor')->nullable();
            $table->string('votersCert')->nullable();
        });
    }
};

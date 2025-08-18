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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id'); // ID for user
            $table->string('first_name', 50); // First Name
            $table->string('middle_name', 50)->nullable(); // Middle Name
            $table->string('last_name', 50); // Last Name
            $table->date('date_of_birth'); // Date of Birth
            $table->enum('gender', ['Male', 'Female', 'Other']); // Gender
            $table->string('contact_number', 20); // Contact Number
            $table->string('email', 100)->unique(); // Email Address
            $table->string('street_address', 255); // Street Address
            $table->string('barangay', 100); // Barangay
            $table->string('city_municipality', 100); // City/Municipality
            $table->string('province', 100); // Province
            $table->string('zip_code', 20); // Zip Code
            $table->string('password'); // Password
            $table->string('profile_picture', 255)->nullable(); // Profile Picture
            $table->foreignId('role_id')->constrained('roles', 'role_id')->onDelete('cascade'); // Role ID
            $table->boolean('is_active')->default(true); // Active Status
            $table->timestamps(); // Timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

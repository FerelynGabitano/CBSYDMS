<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('user_addresses', function (Blueprint $table) {
        $table->id('address_id');
        $table->unsignedBigInteger('user_id')->unique();
        $table->string('street_address')->nullable();
        $table->string('barangay')->nullable();
        $table->string('city_municipality')->nullable();
        $table->string('province')->nullable();
        $table->string('zip_code')->nullable();
        $table->timestamps();

        $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
    });
}

public function down()
{
    Schema::dropIfExists('user_addresses');
}
};

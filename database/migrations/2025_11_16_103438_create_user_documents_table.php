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
    Schema::create('user_documents', function (Blueprint $table) {
        $table->id('document_id');
        $table->unsignedBigInteger('user_id')->unique();
        $table->string('brgyCert')->nullable();
        $table->string('birthCert')->nullable();
        $table->string('gradeReport')->nullable();
        $table->string('idPicture')->nullable();
        $table->string('cor')->nullable();
        $table->string('votersCert')->nullable();
        $table->timestamps();

        $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
    });
}

public function down()
{
    Schema::dropIfExists('user_documents');
}

};

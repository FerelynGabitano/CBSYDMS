<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('scholarship_status', ['Not Started','Ongoing','Accepted','Rejected','Revoked'])
                  ->default('Not Started')
                  ->after('course'); // place after a column of your choice
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('scholarship_status');
        });
    }
};

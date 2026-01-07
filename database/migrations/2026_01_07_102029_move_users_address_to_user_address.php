<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {

        DB::table('users')
            ->select(
                'user_id',
                'street_address',
                'barangay',
                'city_municipality',
                'province',
                'zip_code'
            )
            ->get()
            ->each(function ($user) {
                DB::table('user_address')->insert([
                    'user_id' => $user->id,
                    'street_address' => $user->street_address,
                    'barangay' => $user->barangay,
                    'city_municipality' => $user->city_municipality,
                    'province' => $user->province,
                    'zip_code' => $user->zip_code,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            });
    }

    public function down(): void
    {
        DB::table('user_address')->truncate();
    }
};

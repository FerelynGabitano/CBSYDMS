<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserDataMigrationSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            // Insert address
            DB::table('user_addresses')->insert([
                'user_id' => $user->user_id,
                'street_address' => $user->street_address,
                'barangay' => $user->barangay,
                'city_municipality' => $user->city_municipality,
                'province' => $user->province,
                'zip_code' => $user->zip_code,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Insert documents
            DB::table('user_documents')->insert([
                'user_id' => $user->user_id,
                'brgyCert' => $user->brgyCert,
                'birthCert' => $user->birthCert,
                'gradeReport' => $user->gradeReport,
                'idPicture' => $user->idPicture,
                'cor' => $user->cor,
                'votersCert' => $user->votersCert,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

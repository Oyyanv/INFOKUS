<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id_user' => '001',
            'email' => '543221014@smktelkom-bjb.sch.id',
            'status'   => 'siswa',
            'password' => Hash::make('123')
        ]);

        DB::table('users')->insert([
            'id_user' => '002',
            'email' => 'guru@smktelkom-bjb.sch.id',
            'status'   => 'admin',
            'password' => Hash::make('123')
        ]);
        
    }
}

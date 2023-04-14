<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(10)->create();

         User::factory()->create([
             'name' => 'Szef',
             'last_name'=>"Szef",
             'email' => 'szef@example.com',
             'password' => bcrypt('szef')
         ]);

        User::factory()->create([
            'name' => 'Kierownik',
            'last_name'=>"Kierownik",
            'email' => 'kierownik@example.com',
            'password' => bcrypt('kierownik')
        ]);

        User::factory()->create([
            'name' => 'Obcy',
            'last_name'=>"Obcy",
            'email' => 'obcy@example.com',
            'password' => bcrypt('obcy')
        ]);

        DB::table('roles')->insert([
            [
                'role_name' => 'szef'
            ],
            [
                'role_name' => 'kierownik'
            ]
        ]);

        DB::table('role_user')->insert([
            [
                'user_id' => 11,
                'role_id' => 1
            ],
            [
                'user_id' => 12,
                'role_id' => 2
            ],
        ]);

        DB::table('restauracjas')->insert([
            [
                'name' => "Mamma Mia!"
            ]
        ]);

        DB::table('restauracja_user')->insert([
            [
                'user_id' => 12,
                'restauracja_id' => 1
            ]
        ]);
    }
}

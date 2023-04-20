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
            'name' => 'Pracownik',
            'last_name'=>"Pracownik",
            'email' => 'pracownik@example.com',
            'password' => bcrypt('pracownik')
        ]);

        User::factory()->create([
            'name' => 'Recepcjonistka',
            'last_name'=>"Recepcjonistka",
            'email' => 'recepcjonistka@example.com',
            'password' => bcrypt('recepcjonistka')
        ]);

        DB::table('roles')->insert([
            [
                'role_name' => 'szef'
            ],
            [
                'role_name' => 'kierownik'
            ],
            [
                'role_name' => 'pracownik'
            ],
            [
                'role_name' => 'recepcjonistka'
            ],
            [
                'role_name' => 'magazynier'
            ],
            [
                'role_name' => 'ksiegowa'
            ]
        ]);

        DB::table('role_user')->insert([
            [
                'user_id' => 1,
                'role_id' => 1
            ],
            [
                'user_id' => 2,
                'role_id' => 2
            ],
            [
                'user_id' => 3,
                'role_id' => 3
            ],
            [
                'user_id' => 4,
                'role_id' => 4
            ]
        ]);

        DB::table('restauracjas')->insert([
            [
                'name' => "Mamma Mia!"
            ]
        ]);

        DB::table('restauracja_user')->insert([
            [
                'user_id' => 2,
                'restauracja_id' => 1
            ]
        ]);
    }
}

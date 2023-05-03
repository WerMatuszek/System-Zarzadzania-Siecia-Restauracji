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

        User::factory()->create([
            'name' => 'magazynier',
            'last_name'=> 'magazynier',
            'email' => 'magazynier@example.com',
            'password' => bcrypt('magazynier')
        ]);

        User::factory()->create([
            'name' => 'ksiegowa',
            'last_name'=> 'ksiegowa',
            'email' => 'ksiegowa@example.com',
            'password' => bcrypt('ksiegowa')
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
            ],
            [
                'user_id' => 5,
                'role_id' => 5
            ],
            [
                'user_id' => 6,
                'role_id' => 6
            ]
        ]);

        DB::table('restauracjas')->insert([
            [
                'name' => "MammaMia!"
            ],
            [
                'name' => 'Pommidoro!'
            ]
        ]);

        DB::table('restauracja_user')->insert([
            [
                'user_id' => 2,
                'restauracja_id' => 1
            ],
            [
                'user_id' => 3,
                'restauracja_id' => 1
            ],
            [
                'user_id' => 4,
                'restauracja_id' => 1
            ]
        ]);

        DB::table('dostawies')->insert([
            [
                'name' => 'Pomidor'
            ],
            [
                'name' => 'Mozarella'
            ],
            [
                'name' => 'Mąka'
            ],
            [
                'name' => 'Sól'
            ],
            [
                'name' => 'Pieczarki'
            ]
        ]);

        DB::table('restauracja_dostawa')->insert([
            [
                'produkt_id' => 2,
                'restauracja_id' => 1,
                'ilość' => 5
            ],
            [
                'produkt_id' => 3,
                'restauracja_id' => 1,
                'ilość' => 10
            ],
            [
                'produkt_id' => 4,
                'restauracja_id' => 1,
                'ilość' => 2
            ],
            [
                'produkt_id' => 2,
                'restauracja_id' => 2,
                'ilość' => 15
            ],
            [
                'produkt_id' => 1,
                'restauracja_id' => 2,
                'ilość' => 8
            ],
        ]);
    }
}

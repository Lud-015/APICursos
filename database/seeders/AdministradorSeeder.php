<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdministradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([

            'name' => 'Roxana',
            'appaterno' => 'Romay',
            'apmaterno' => 'Araujo',
            'CI' => '00',
            'Celular' => '71234567',
            'fechadenac' => '0000-00-00',
            'email' => 'educarparalavida.fund@gmail.com',
            'password' => bcrypt('admin123'),

        ]);

        $user-> assignRole('Administrador');
    }
}

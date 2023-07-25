<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
        [
            [
            'name' => 'Nanet Taboada Frias',
            'perfil' => '/administradores/1/img_6264194c1be9e.png',
            'email' => 'nanet@gmail.com',       
            'password' =>Hash::make('111'),   
            'estado' => 0,
            'tipoUsuario' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ],
            [
            'name' => 'Dayler Taboada Frias',
            'perfil' => '/administradores/1/img_6264194c1be9e.png',
            'email' => 'nanet7777@gmail.com',    
            'password' =>Hash::make('111'),   
            'estado' => 0,
            'tipoUsuario' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ],
            [
            'name' => 'Luis Edwin Padilla',
            'perfil' => '/administradores/1/img_6264194c1be9e.png',
            'email' => 'nanet8888@gmail.com',    
            'password' =>Hash::make('111'),   
            'estado' => 0,
            'tipoUsuario' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        ]);
    }
}

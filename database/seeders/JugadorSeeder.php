<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class JugadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jugador')->insert(
        [
            [
            'nombres' => 'Nanet',
            'apellidos'=> 'Taboada Frias',
            'perfil' => '/jugadores/1/img_6264194c1be9e.png',
            'ci' => '236326',
            'puntaje' => 0,
            'email' => 'nanet7777@gmail.com',    
            'password' =>'111',   
            'eliminado' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ],
            [
            'nombres' => 'Dayler',
            'apellidos'=> 'Taboada Frias',
            'perfil' => '/jugadores/2/img_6264194c1be9e.png',
            'ci' => '235325',
            'puntaje' => 0,
            'email' => 'nanet8888@gmail.com',    
            'password' =>'111',   
            'eliminado' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        ]);
    }
}

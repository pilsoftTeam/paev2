<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios')->insert([
            'name' => 'Junaeb',
            'email' => 'junaeb@pae.cl',
            'password' => bcrypt('junaeb'),
        ]);

        DB::table('perfiles')->insert([
            'idRol' => 1,
            'idUsuario' => 1
        ]);



        DB::table('usuarios')->insert([
            'name' => 'Admin',
            'email' => 'admin@pae.cl',
            'password' => bcrypt('admin'),
        ]);

        DB::table('perfiles')->insert([
            'idRol' => 2,
            'idUsuario' => 2
        ]);



        DB::table('usuarios')->insert([
            'name' => 'Supervisor',
            'email' => 'supervisor@pae.cl',
            'password' => bcrypt('supervisor'),
        ]);

        DB::table('perfiles')->insert([
            'idRol' => 3,
            'idUsuario' => 3
        ]);



        DB::table('usuarios')->insert([
            'name' => 'Revisor',
            'email' => 'supervisor@pae.cl',
            'password' => bcrypt('supervisor'),
        ]);

        DB::table('perfiles')->insert([
            'idRol' => 4,
            'idUsuario' => 4
        ]);
    }
}

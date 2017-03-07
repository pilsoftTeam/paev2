<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['junaeb', 'administrador', 'supervisor', 'supervisor'];
        foreach ($roles as $rol) {
            DB::table('roles')->insert([
                'nombreRol' => $rol
            ]);
        }

    }
}

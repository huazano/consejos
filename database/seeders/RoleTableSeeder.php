<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'admin';
        $role->description = 'Perfil de control total del sistema, destinado únicamente a TI.';
        $role->save();

        $role = new Role();
        $role->name = 'visitor';
        $role->description = 'Perfil de visitante sin permisos de ningún tipo.';
        $role->save();
    }
}

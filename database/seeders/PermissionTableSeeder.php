<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = new Permission();

        $permission->name = 'Administrator';
        $permission->description = 'In charge of system management, with total control.';
        $permission->save();

        $permission = new Permission();

        $permission->name = 'Jurídico Global';
        $permission->description = 'Personal encargado de revisar la evidencia de los eventos.';
        $permission->save();

        $permission = new Permission();

        $permission->name = 'Jurídico';
        $permission->description = 'Personal encargado de revisar la evidencia de los eventos.';
        $permission->save();

        $permission = new Permission();

        $permission->name = 'Enlace Siconecta';
        $permission->description = 'Personal encargado de revisar la evidencia de los eventos.';
        $permission->save();

        $permission = new Permission();

        $permission->name = 'Organización';
        $permission->description = 'Personal encargado de registro de asistencia, llenado de actas parciales y subir evidencia.';
        $permission->save();
    }
}

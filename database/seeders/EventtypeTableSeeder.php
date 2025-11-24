<?php

namespace Database\Seeders;

use App\Models\Eventtype;
use Illuminate\Database\Seeder;

class EventtypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $eventType = new Eventtype();
        $eventType->name = 'Legitimación';
        $eventType->description = 'Evento de legitimación de contrato colectivo de trabajo, el cual incluye, asistencia, votaciones, documentos, evidencias y estadísticas';
        $eventType->save();
    }
}

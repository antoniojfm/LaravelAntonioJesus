<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alumnos')->insert([
            [
                'nombre' => 'Antonio Jesus',
                'apellido' => 'Fernandez Molina',
                'email' => 'antonio.fernandez@escuelaestech.es',
                'edad' => 21,
                'direccion' => 'C/ Prior Pellon 5',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nombre' => 'Pepe',
                'apellido' => 'Molina',
                'email' => 'pepe.molina@escuelaestech.es',
                'edad' => 70,
                'direccion' => 'C/ Prior Pellon 8',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);
    }
}

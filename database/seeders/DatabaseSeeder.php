<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Alumno;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Creamos 10 elementos de usuarios.
        User::factory(10)->create();
        

        $this->call([
            AlumnoSeeder::class,
            PostSeeder::class,
        ]);

    }
}

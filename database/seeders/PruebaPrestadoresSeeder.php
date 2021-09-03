<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PruebaPrestadoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Prestador::factory(50)->create();
    }
}

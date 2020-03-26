<?php

use Illuminate\Database\Seeder;

class QEtypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('qe_types')->insert([
            'type' => 'Qe',
        ]);
        DB::table('qe_types')->insert([
            'type' => 'tache',
        ]);
        DB::table('qe_types')->insert([
            'type' => 'liste',
        ]);
    }
}

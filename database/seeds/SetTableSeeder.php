<?php

use Illuminate\Database\Seeder;

class SetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Set::create([
            'name' => 'A'
        ]);
        App\Set::create([
            'name' => 'B'
        ]);
        App\Set::create([
            'name' => 'C'
        ]);
    }
}

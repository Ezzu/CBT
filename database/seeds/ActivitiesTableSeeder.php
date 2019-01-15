<?php

use Illuminate\Database\Seeder;

class ActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Activity::create(['name' => 'Logged In']);
        App\Activity::create(['name' => 'Logged Out']);
        App\Activity::create(['name' => 'Test Started']);
        App\Activity::create(['name' => 'Test Ended']);
        App\Activity::create(['name' => 'Question Created']);
        App\Activity::create(['name' => 'Question Approved']);
        App\Activity::create(['name' => 'Question Trashed']);
        App\Activity::create(['name' => 'Question Restored']);
        App\Activity::create(['name' => 'Question Modified']);
        App\Activity::create(['name' => 'Test Granted']);
        App\Activity::create(['name' => 'Test Snatched']);
        App\Activity::create(['name' => 'Test Generated']);
        App\Activity::create(['name' => 'Password Changed']);
        App\Activity::create(['name' => 'Has Token']);
        App\Activity::create(['name' => 'Test Selected']);
    }
}

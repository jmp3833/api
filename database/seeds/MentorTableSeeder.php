<?php

use Illuminate\Database\Seeder;

class MentorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Mentor', 50)->create()->each(function ($mentor) {
            $mentor->save();
        });
    }
}

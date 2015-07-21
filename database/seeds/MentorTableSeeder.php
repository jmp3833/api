<?php

use Illuminate\Database\Seeder;

use App\Mentor;

class MentorTableSeeder extends Seeder
{
    /**
     * Run the database seeds for Mentor objects.
     *
     * @return void
     */
    public function run()
    {
        $mentor = new Mentor();
        $mentor->member_id = 1;    

        $mentor->save();
    }
}

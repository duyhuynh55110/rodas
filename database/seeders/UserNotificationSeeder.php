<?php

namespace Database\Seeders;

use App\Models\UserNotification;
use Illuminate\Database\Seeder;

class UserNotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // number of random data
        $count = 500;

        // create random notifications
        UserNotification::factory()->count($count)->create();
    }
}

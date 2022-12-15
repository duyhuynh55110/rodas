<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // You should install this only one time after install source
        $this->call([
            UserSeeder::class,
            UserNotificationSeeder::class,
            CountrySeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            GiftBoxSeeder::class,
        ]);
    }
}

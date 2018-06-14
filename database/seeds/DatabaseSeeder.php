<?php

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
        // Clear out the database records and start from scratch
        \Illuminate\Support\Facades\Artisan::call('migrate:refresh');

        // Create a default admin user
        \App\User::create([
            'name' => 'Admin',
            'email' => 'admin@axlapi.com',
            'password' => bcrypt('p@$$word!')
        ]);

        // Create 10 Cucm model instances
        factory(\App\Cucm::class, 10)->create();
    }
}

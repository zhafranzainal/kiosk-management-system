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
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);
        $this->call(PermissionsSeeder::class);

        $this->call(ApplicationSeeder::class);
        $this->call(BankSeeder::class);
        $this->call(BusinessTypeSeeder::class);
        $this->call(ComplaintSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(KioskSeeder::class);
        $this->call(KioskParticipantSeeder::class);
        $this->call(SaleSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(TransactionSeeder::class);
        $this->call(UserSeeder::class);
    }
}

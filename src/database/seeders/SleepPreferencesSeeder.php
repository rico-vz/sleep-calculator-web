<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\SleepPreferences;

class SleepPreferencesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        foreach ($users as $user) {
            SleepPreferences::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'fall_asleep_time' => 14,
                ]
            );

            $this->command->info('Sleep preferences created for user: ' . $user->name);
        }
    }
}

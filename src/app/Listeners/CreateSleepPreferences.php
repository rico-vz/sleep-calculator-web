<?php

namespace App\Listeners;

use App\Models\SleepPreferences;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class CreateSleepPreferences
{
    /**
     * Handle the event.
     */
    public function handle(\Illuminate\Auth\Events\Registered $event): void
    {
        Log::info('Registered event for user: ' . $event->user->name);
        /** @var User $user */
        $user = $event->user;

        if ($user && $user->sleepPreferences()->doesntExist()) {
            SleepPreferences::create([
                'user_id' => $user->id,
                'fall_asleep_time' => 15,
            ]);
        }
    }
}

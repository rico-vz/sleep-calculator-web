<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('backup:database')
    ->dailyAt('02:00')
    ->sendOutputTo(storage_path('logs/backup.log'))
    ->emailOutputOnFailure(config('mail.failure_email_to'));

Schedule::command('backup:clean')
    ->dailyAt('03:00')
    ->sendOutputTo(storage_path('logs/backup.log'))
    ->emailOutputOnFailure(config('mail.failure_email_to'));

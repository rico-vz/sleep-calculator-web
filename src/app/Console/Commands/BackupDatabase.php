<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Storage;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a backup from the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $path = Storage::path("/backups/" . date('Y-m-d_H-i-s') . ".gz");

        $this->info("Creating backup at $path");

        $dbUsername = config('database.connections')[config('database.default')]['username'];
        $dbPassword = config('database.connections')[config('database.default')]['password'];
        $dbHost = config('database.connections')[config('database.default')]['host'];
        $dbName = config('database.connections')[config('database.default')]['database'];


        $command = "mariadb-dump --single-transaction --user=$dbUsername --password=$dbPassword --host=$dbHost $dbName | gzip > $path";

        $proc = Process::run($command);

        if ($proc->successful()) {
            $this->info("Backup created successfully at $path");
        } else {
            $this->error("Error creating backup: " . $proc->errorOutput());
        }
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Storage;

class BackupClean extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up old backups';

    /**
     * The amount of backups to keep.
     *
     * @var int
     */
    protected $backupsToKeep = 5;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Cleaning up old backups...");

        $files = Storage::files('backups');

        usort($files, function ($a, $b) {
            return Storage::lastModified($a) <=> Storage::lastModified($b);
        });

        $filesToDelete = array_slice($files, 0, count($files) - $this->backupsToKeep);

        foreach ($filesToDelete as $file) {
            Storage::delete($file);
            $this->info("Deleted backup: $file");
        }

        $this->info("Cleanup complete.");
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DeleteReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete-report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $directory = 'reports';

        $files = Storage::disk('public')->files($directory);

        foreach ($files as $file) {
            Storage::disk('public')->delete($file);
        }
        $this->info('Excel fayllar tozalandi');
    }
}

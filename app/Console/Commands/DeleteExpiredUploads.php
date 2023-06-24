<?php

namespace App\Console\Commands;

use App\Models\Upload;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteExpiredUploads extends Command
{
    protected $signature = 'uploads:delete-expired';

    protected $description = 'Delete expired uploads from server';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $expiredUploads = Upload::where('expired_at', '<', Carbon::now())->get();

        foreach ($expiredUploads as $upload) {
            $upload->clearMediaCollection();
            $upload->delete();
        }

        $this->info('Expired uploads have been deleted.');
        return Command::SUCCESS;
    }
}

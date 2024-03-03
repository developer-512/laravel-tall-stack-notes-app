<?php

namespace App\Console\Commands;

use App\Jobs\SendEmail;
use App\Models\Note;
use Carbon\Carbon;
use Illuminate\Console\Command;

class sendScheduledNotes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-scheduled-notes';

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
        $now=Carbon::now();
        $notes=Note::where('is_published',true)
            ->where('send_date',$now->toDateString())
            ->get();
        $notesCount=$notes->count();
        $this->info("Sending {$notesCount} Notes");

        foreach ($notes as $note){
            SendEmail::dispatch($note);
        }
    }
}

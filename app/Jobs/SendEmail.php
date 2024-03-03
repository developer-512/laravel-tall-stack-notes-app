<?php

namespace App\Jobs;

use App\Models\Note;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Note $note)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $noteUrl=route('notes.view',$this->note->id);
        $emailContent="Hello, You've received a new note. View it here: {$noteUrl}";
        Mail::raw($emailContent,function ($message){
        $message->from('sharenotes@efmail.com','EF Notes')
            ->to($this->note->recipient)
            ->subject('You Have a New Note from '.$this->note->user->name);
        });
    }
}

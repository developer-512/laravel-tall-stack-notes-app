<?php

use Livewire\Volt\Component;

new class extends Component {
    public $noteTitle, $noteBody,$noteRecipient,$noteSendDate;

    public function submit(){
        $validated=$this->validate([
           'noteTitle'=>['required','string','min:5'],
           'noteBody'=>['required','string','min:25'],
            'noteRecipient'=>['required','email'],
            'noteSendDate'=>['required','date'],
        ]);
        auth()->user()->notes()->create([
          'title'=>$this->noteTitle,
          'body'=>$this->noteBody,
          'recipient'=>$this->noteRecipient,
          'send_date'=>$this->noteSendDate ,
          'is_published'=>true
        ]);
        redirect()->route('notes.index');
        //dd($this->noteTitle,$this->noteBody,$this->noteRecipient,$this->noteSendDate);

    }


}; ?>

<div>
    <form wire:submit="submit" class="space-y-4">
        <x-input wire:model="noteTitle" label="Note Title" placeholder="It's been a great day."></x-input>
        <x-textarea wire:model="noteBody" label="Yur Note" min="25"></x-textarea>
        <x-input icon="user" wire:model="noteRecipient" label="Recipient(s)" placholder="yourfiend@email.com" type="email"></x-input>
        <x-input icon="calendar" wire:model="noteSendDate" type="date" label="Send Date"></x-input>
        <div class="pt-4">
            <x-button wire:click="submit"  primary right-icon="calendar" spinner>Schedule Note</x-button>
        </div>
        <x-errors />
    </form>
</div>

<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Note;
use WireUi\Traits\Actions;

new #[Layout('layouts.app')] class extends Component {
    use Actions;

    public Note $note;
    public $noteTitle, $noteBody,$noteRecipient,$noteSendDate,$noteIsPublished;
    public function mount(Note $note)
    {
        $this->authorize('update',$note);
        $this->fill($note);
        $this->noteTitle=$note->title;
        $this->noteBody=$note->body;
        $this->noteRecipient=$note->recipient;
        $this->noteSendDate=$note->send_date;
        $this->noteIsPublished=$note->is_published;

    }
    public function saveNote(){
        $validated=$this->validate([
            'noteTitle'=>['required','string','min:5'],
            'noteBody'=>['required','string','min:25'],
            'noteRecipient'=>['required','email'],
            'noteSendDate'=>['required','date'],
            'noteIsPublished'=>['boolean'],
        ]);
        $this->note->update([
            'title'=>$this->noteTitle,
            'body'=>$this->noteBody,
            'recipient'=>$this->noteRecipient,
            'send_date'=>$this->noteSendDate ,
            'is_published'=>$this->noteIsPublished
        ]);
        $this->notification()->success(
            $title = 'Note Updated',
            $description = 'Your Note is successfully updated '
        );
//        redirect()->route('notes.index');
    }
}; ?>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Edit Note') }}
        </h2>
    </x-slot>
<div class="py-12">
    <div class="mx-auto max-w-2xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div>
                    <form wire:submit="saveNote" class="space-y-4">
                        <x-input wire:model="noteTitle" label="Note Title" placeholder="It's been a great day."></x-input>
                        <x-textarea wire:model="noteBody" label="Yur Note" min="25"></x-textarea>
                        <x-input icon="user" wire:model="noteRecipient" label="Recipient(s)" placholder="yourfiend@email.com" type="email"></x-input>
                        <x-input icon="calendar" wire:model="noteSendDate" type="date" label="Send Date"></x-input>
                        <x-toggle md  wire:model="noteIsPublished"  label="Note Published"></x-toggle>
                        <div class="pt-4 flex justify-between">
                            <x-button type="submit"  secondary right-icon="calendar" spinner="saveNote">Save Note</x-button>
                            <x-button href="{{route('notes.index')}}"  flat negetive>Cancel</x-button>
                        </div>

                        <x-errors />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


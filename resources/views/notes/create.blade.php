<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Create a note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-2xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-4 dark:text-gray-100">
                    <x-button icon="arrow-left" class="mb-8" href="{{route('notes.index')}}">All Notes</x-button>
                   <livewire:notes.create-note/>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

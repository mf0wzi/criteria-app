<div class="p-6 sm:px-20 bg-white border-b border-gray-200">

    <div class="flex items-center justify-between mt-8 text-2xl">
        Welcome to your Selection app
        <x-jet-button wire:click="activate">
            {{ __('Upload Excel') }}
        </x-jet-button>

        <x-jet-dialog-modal wire:model="confirmingActivation">
            <x-slot name="title">
                {{ __('Upload Excel') }}
            </x-slot>
            <x-jet-form-section submit="submit">
                <x-slot name="title">
                </x-slot>
                <x-slot name="description">
                </x-slot>
                <x-slot name="form">
                </x-slot>
                <x-slot name="actions">
                </x-slot>
            </x-jet-form-section>
            <x-slot name="content">
                <div class="bg-white rounded px-8 pt-6 pb-8 mb-2 flex flex-col my-2">
                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-full px-3">
                            <x-jet-label for="name" value="Name" class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" />
                            <div>
                                <x-jet-input id="name" placeholder="File name" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3 shadow-sm text-base placeholder-gray-500 placeholder-opacity-50 outline-none-500 focus:outline-none focus:border-blue-500" type="text" name="name" :value="old('name')" required autofocus />
                            </div>
                            <x-jet-input-error for="name" class="mt-2" />
                            <p class="text-red text-xs italic">Please fill out this field.</p>
                        </div>
                    </div>
                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-full px-3">
                            <x-jet-label for="description" value="Description" class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" />
                            <div>
                                <x-jet-textarea id="description" placeholder="Description" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3 shadow-sm text-base placeholder-gray-500 placeholder-opacity-50 outline-none-500 focus:outline-none focus:border-blue-500" name="description" :value="old('description')" required/>
                            </div>
                            <p class="text-grey-dark text-xs italic">Make it as long and as crazy as you'd like</p>
                        </div>
                    </div>
                    <div class="-mx-3 md:flex mb-2">
                        <div class="md:w-full px-3">
                            <x-jet-label for="excelFile" value="Excel Upload" class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" />
                            <div>
                                <x-jet-input id="excelFile" placeholder="File name" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3 shadow-sm text-base placeholder-gray-500 placeholder-opacity-50 outline-none-500 focus:outline-none focus:border-blue-500" type="file" name="excelFile" :value="old('excelFile')" required/>
                            </div>
                        </div>
                    </div>
                </div>
            </x-slot>

            <x-jet-secondary-button wire:click="$toggle('confirmingActivation')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-jet-button id="submit" name="submit" type="submit" class="ml-2" wire:loading.attr="disabled">
                {{ __('Upload excel now') }}
            </x-jet-button>
            </x-slot>

            </x-slot>

            <x-slot name="footer">
                <x-slot name="actions">
                    <x-jet-secondary-button wire:click="$toggle('confirmingActivation')" wire:loading.attr="disabled">
                        {{ __('Nevermind') }}
                    </x-jet-secondary-button>

                    <x-jet-button id="submit" name="submit" type="submit" class="ml-2" wire:loading.attr="disabled">
                        {{ __('Upload excel now') }}
                    </x-jet-button>
                </x-slot>
            </x-slot>

        </x-jet-dialog-modal>
    </div>

    <div class="mt-1 mb-8 text-gray-500">

        <livewire:datatable
            model="App\Models\User"
            include="id, name, created_at"
            dates="dob"
        />

    </div>
</div>


<x-jet-form-section submit="submit">
    <x-slot name="title">
    </x-slot>
    <x-slot name="description">
    </x-slot>
    <x-slot name="form">
    </x-slot>
    <x-slot name="actions">
    </x-slot>
</x-jet-form-section>

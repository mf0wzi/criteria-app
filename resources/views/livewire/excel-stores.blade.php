<div class="p-6 sm:px-20 bg-white border-b border-gray-200">

    <div class="flex items-center justify-between mt-8 text-2xl">
        Welcome to your Selection app

        <x-jet-action-message class="mr-3" on="saved">
            {{ __('File successfully Uploaded.') }}
        </x-jet-action-message>

        <div>
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>

        <x-jet-button wire:click="activate">
            {{ __('Upload Excel') }}
        </x-jet-button>

        <x-jet-dialog-modal wire:model="confirmingActivation" class="main-modal fixed w-full inset-0 z-50 overflow-hidden flex justify-center items-center animated faster fadeIn">
            <form>
                <x-slot name="title">
                    {{ __('Upload Excel') }}
                </x-slot>

                <x-slot name="content">
                    <div class="loading" wire:loading wire:target="submit">
                        Submit in Process...
                    </div>
                    <div class="bg-white rounded px-8 pt-6 pb-8 mb-2 flex flex-col my-2">
                        <div class="-mx-3 md:flex mb-6">
                            <div class="md:w-full px-3">
                                <x-jet-label for="name" value="Name" class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" />
                                <div>
                                    <x-jet-input id="name" placeholder="File name" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3 shadow-sm text-base placeholder-gray-500 placeholder-opacity-50 outline-none-500 focus:outline-none focus:border-blue-500" type="text" name="name" :value="old('name')" wire:model="name" required autofocus />
                                </div>
                                <x-jet-input-error for="name" class="mt-2" />
                                <p class="text-red text-xs italic">Please fill out this field.</p>
                            </div>
                        </div>
                        <div class="-mx-3 md:flex mb-6">
                            <div class="md:w-full px-3">
                                <x-jet-label for="description" value="Description" class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" />
                                <div>
                                    <x-jet-textarea
                                        id="description"
                                        placeholder="Description"
                                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3 shadow-sm text-base placeholder-gray-500 placeholder-opacity-50 outline-none-500 focus:outline-none focus:border-blue-500"
                                        name="description"
                                        :value="old('description')"
                                        wire:model="description" required/>
                                </div>
                                <x-jet-input-error for="description" class="mt-2" />
                                <p class="text-grey-dark text-xs italic">Make it as long and as crazy as you'd like</p>
                            </div>
                        </div>
                        <div class="-mx-3 md:flex mb-2">
                            <div class="md:w-full px-3">
                                <x-jet-label for="excelFile" value="Excel Upload" class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" />
                                <div>
                                    <x-jet-input id="excelFile" placeholder="File name" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3 shadow-sm text-base placeholder-gray-500 placeholder-opacity-50 outline-none-500 focus:outline-none focus:border-blue-500" type="file" name="excelFile" :value="old('excelFile')" wire:model="excelFile" required/>
                                </div>
                                <x-jet-input-error for="excelFile" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </x-slot>

                <x-slot name="footer">
                    <x-jet-secondary-button wire:click.prevent="$toggle('confirmingActivation')" wire:loading.attr="disabled">
                        {{ __('Nevermind') }}
                    </x-jet-secondary-button>

                    <x-jet-button id="submit" name="submit" type="submit" wire:click.prevent="submit" class="ml-2" wire:loading.attr="disabled">
                        {{ __('Upload excel now') }}
                    </x-jet-button>
                </x-slot>
            </form>
        </x-jet-dialog-modal>

    </div>

    <div class="mt-1 mb-8 text-gray-500">

        <livewire:excel-list/>
        {{--        <livewire:view-upload-excel :params="values"/>--}}

        <x-jet-dialog-modal maxWidth="3xl" class="pointer-events-none" wire:model="actionActivation">
            <form>
                <x-slot name="title">
                    @if($viewType === 'view')
                        {{ __('View') }}
                    @elseif($viewType === 'viewUnqualifyForm')
                        {{ __('Add Unqualified Criteria') }}
                    @elseif($viewType === 'viewCriteriaForm')
                        {{ __('Show Criteria') }}
                    @elseif($viewType === 'edit')
                        {{ __('Edit') }}
                    @elseif($viewType === 'Delete')
                        {{ __('Delete') }}
                    @endif
                </x-slot>

                <x-slot name="content">
                    <div class="loading" wire:loading>
                        Submit in Process...
                    </div>
                    @if($viewType === 'view')
                        <livewire:view-upload-excel :params="[$rowId,$rowUUID,$rowTableName,$rowHeaderData]"/>
                    @elseif($viewType === 'viewUnqualifyForm')
                        <div>
                        <livewire:selection-filters wire:key="'selection-filters-'.{{ $rowId }}" :params="[$rowId,$rowUUID,$rowTableName,$rowHeaderData]"/>
                        </div>
                    @elseif($viewType === 'viewIfForm')
                        <div>
                            <livewire:selection-if-parent-filters wire:key="'selection-if-parent-filters-'.{{ $rowId }}" :params="[$rowId,$rowUUID,$rowTableName,$rowHeaderData]"/>
                        </div>
                    @elseif($viewType === 'viewCriteriaForm')
                        <livewire:view-full-criteria wire:key="'view-full-criteria-'.{{ $rowId }}" :params="[$rowId,$rowUUID,$rowTableName,$rowHeaderData]"/>
                    @elseif($viewType === 'edit')
                        {{ __('Edit') }}
                    @elseif($viewType === 'Delete')
                        {{ __('Delete') }}
                    @endif
                </x-slot>

                <x-slot name="footer">
                    @if($viewType === 'view')
                        <div class="flex justify-start">
                            <x-jet-secondary-button wire:click.prevent="deactivateAction" wire:loading.attr="disabled">
                                {{ __('Nevermind') }}
                            </x-jet-secondary-button>
                        </div>
                    @elseif($viewType === 'viewUnqualifyForm')
                        <div class="flex justify-start">
                            <x-jet-secondary-button wire:click.prevent="deactivateAction" wire:loading.attr="disabled">
                                {{ __('Nevermind') }}
                            </x-jet-secondary-button>
{{--                            <x-jet-button id="submitQualification" name="submitQualification" type="submit" wire:click.prevent="$emitTo('selection-filters', 'submit')" class="ml-2" wire:loading.attr="disabled">--}}
{{--                                {{ __('Save Qualification Logic') }}--}}
{{--                            </x-jet-button>--}}
                            <x-jet-button id="submitQualification" name="submitQualification" type="submit" wire:click.prevent="selectionFilters" class="ml-2" wire:loading.attr="disabled">
                                {{ __('Save Qualification Logic') }}
                            </x-jet-button>
                        </div>
                    @elseif($viewType === 'viewCriteriaForm')
                        <div class="flex justify-start">
                            <x-jet-secondary-button wire:click.prevent="deactivateAction" wire:loading.attr="disabled">
                                {{ __('Nevermind') }}
                            </x-jet-secondary-button>
                        </div>
                    @elseif($viewType === 'edit')
                        <div class="flex justify-start">
                            <x-jet-secondary-button wire:click.prevent="deactivateAction" wire:loading.attr="disabled">
                                {{ __('Nevermind') }}
                            </x-jet-secondary-button>

                            <x-jet-button id="submit" name="submit" type="submit" wire:click.prevent="submit" class="ml-2" wire:loading.attr="disabled">
                                {{ __('Edit') }}
                            </x-jet-button>
                        </div>
                    @elseif($viewType === 'Delete')
                        <div class="flex justify-start">
                            <x-jet-secondary-button wire:click.prevent="deactivateAction" wire:loading.attr="disabled">
                                {{ __('Nevermind') }}
                            </x-jet-secondary-button>

                            <x-jet-button id="submit" class="bg-red-600 hover:bg-red-500 focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600" name="submit" type="submit" wire:click.prevent="submit" class="ml-2" wire:loading.attr="disabled">
                                {{ __('Delete') }}
                            </x-jet-button>
                        </div>
                    @endif
                </x-slot>
            </form>
        </x-jet-dialog-modal>

        <x-jet-dialog-modal maxWidth="3xl" class="pointer-events-none" wire:model="groupActivation">
            <form>
                <x-slot name="title">
                    {{ __('View') }}
                </x-slot>

                <x-slot name="content">
                    <div class="loading" wire:loading>
                        Submit in Process...
                    </div>
                    <livewire:selection-filter-groups wire:key="'selection-filter-groups-'.{{ $rowId }}.{{ now() }}" :params="[$rowId,$rowUUID,$rowTableName]"/>
                </x-slot>

                <x-slot name="footer">
                    <div class="flex justify-start">
                        <x-jet-secondary-button wire:click.prevent="deactivateGroupModal" wire:loading.attr="disabled">
                            {{ __('Nevermind') }}
                        </x-jet-secondary-button>
                        <x-jet-button id="submitGroupQualification" name="submitGroupQualification" type="submit" wire:click.prevent="$emitTo('selection-filter-groups', 'submitData')" class="ml-2" wire:loading.attr="disabled">
                            {{ __('Save Group Qualification Logic') }}
                        </x-jet-button>
                    </div>
                </x-slot>
            </form>
        </x-jet-dialog-modal>

        <x-jet-dialog-modal maxWidth="3xl" class="pointer-events-none" wire:model="ifActivation">
            <form>
                <x-slot name="title">
                    {{ __('View') }}
                </x-slot>

                <x-slot name="content">
                    <div class="loading" wire:loading>
                        Submit in Process...
                    </div>
                    <livewire:selection-if-filters wire:key="'selection-if-filters-'.{{ $rowId }}.{{ now() }}" :params="[$rowId,$rowUUID,$rowTableName]"/>
                </x-slot>

                <x-slot name="footer">
                    <div class="flex justify-start">
                        <x-jet-secondary-button wire:click.prevent="deactivateIfModal" wire:loading.attr="disabled">
                            {{ __('Nevermind') }}
                        </x-jet-secondary-button>
                        <x-jet-button id="submitGroupQualification" name="submitIfQualification" type="submit" wire:click.prevent="$emitTo('selection-if-filters', 'submitData')" class="ml-2" wire:loading.attr="disabled">
                            {{ __('Save IF Logic') }}
                        </x-jet-button>
                    </div>
                </x-slot>
            </form>
        </x-jet-dialog-modal>


    </div>
</div>

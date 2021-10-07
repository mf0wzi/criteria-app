<div class="flex space-x-1 justify-around">

    <div id="view_{{ $rowId }}" x-data="{ open: false }" class="wrapper">
        <button  @click="open = true" class="text-gray-700 font-semibold py-2 px-4 rounded inline-flex items-center">
            <i class="fas fa-eye"></i>
        </button>

        <div x-show="open" @click.away="open = false" class="tooltip left">
            <ul class="" tabindex="0">
                <li class="">
                    <button wire:click="view({{ $rowId }}, '{{ $rowUUID }}', '{{ $rowTableName }}', 'view', {{ $rowHeaderData }})">
                            <span style="white-space: nowrap;">
                            <p><i class="fas fa-file-excel"></i> View Uploaded Excel</p>
                            </span>
                    </button>
                    <hr>
                </li>
                <li class="">
                    @if($rowCriteriaCount > 0)
                    <button wire:click="view({{ $rowId }}, '{{ $rowUUID }}', '{{ $rowTableName }}', 'viewCriteriaForm', {{ $rowHeaderData }})">
                        <span style="white-space: nowrap;">
                            <p><i class="far fa-file-excel"></i> View Excel after criteria</p>
                        </span>
                    </button>
                    <hr>
                        @else
                        <span class="text-red" style="white-space: nowrap;">
                            <p><i class="far fa-question"></i> Please add your criteria first</p>
                        </span>
                        <hr>
                        @endif
                </li>
            </ul>
        </div>
    </div>

    <div id="qualification_{{ $rowId }}" x-data="{ open: false }" class="wrapper">
        <button  @click="open = true" class="text-gray-700 font-semibold py-2 px-4 rounded inline-flex items-center">
            <i class="fas fa-tasks"></i>
        </button>

        <div x-show="open" @click.away="open = false" class="tooltip left">
            <ul class="group-hover:visible block text-gray-700 pt-1 ">
                <li class="">
                    <button wire:click="view({{ $rowId }}, '{{ $rowUUID }}', '{{ $rowTableName }}', 'viewUnqualifyForm', {{ $rowHeaderData }})">
                            <span style="white-space: nowrap;">
                            <p><i class="fas fa-not-equal"></i> Qualification selection</p>
                            </span>
                    </button>
                    <hr>
                </li>
                <li class="">
                    <button wire:click="view({{ $rowId }}, '{{ $rowUUID }}', '{{ $rowTableName }}', 'viewIfForm', {{ $rowHeaderData }})">
                            <span style="white-space: nowrap;">
                            <p><i class="fas fa-exclamation"></i></i> IF selection</p>
                            </span>
                    </button>
                    <hr>
                </li>
            </ul>
        </div>
    </div>

    <div id="actions_{{ $rowId }}" x-data="{ open: false }" class="wrapper">
        <button  @click="open = true" class="text-gray-700 font-semibold py-2 px-4 rounded inline-flex items-center">
            <i class="fas fa-ellipsis-v"></i>
        </button>

        <div x-show="open" @click.away="open = false" class="tooltip left">
            <ul class="" tabindex="0">
                <li class="">
                    <span wire:click="edit({{ $rowId }})" style="white-space: nowrap;">
                        <p><i class="fas fa-edit"></i> Edit</p>
                    </span>
                    <hr>
                </li>
                <li class="">
                    <span wire:click="delete({{ $rowId }})" style="white-space: nowrap;">
                        <p><i class="fas fa-trash"></i> Delete</p>
                    </span>
                    <hr>
                </li>
            </ul>
        </div>
    </div>

</div>

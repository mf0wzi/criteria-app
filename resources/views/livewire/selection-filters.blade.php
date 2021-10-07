<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <div class="flex flex-row space-x-4 space-x mt-2 mb-2">
                    <x-jet-button id="addField" name="addField" wire:click.prevent="addField" class="ml-2 bg-blue-400" wire:loading.attr="disabled">
                        {{ __('+ Add New Field') }}
                    </x-jet-button>

                    <x-jet-button id="addGroup" name="addGroup" wire:click.prevent="$emit('openGroupModal')" class="ml-2 bg-yellow-500" wire:loading.attr="disabled">
                        {{ __('+ Add New Group') }}
                    </x-jet-button>
                </div>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="hidden px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            ID
                        </th>
                        <th scope="col" class="hidden px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Parent ID
                        </th>
                        <th scope="col" class="hidden px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Parent UUID
                        </th>
                        <th scope="col" class="hidden px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Parent Table Name
                        </th>
                        <th scope="col" class="hidden px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Criteria Type
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Criteria Condition
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Fields
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Criteria Operator
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Value
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($selectedFields as $keys => $selectedField)
                        @if($selectedFields[$keys]['criteria_group_uuid'])
                            @if($selectedFields[$keys]['criteria_group_level'] === 1)

                                {{-- Here starts Childs --}}

                                <tr id="unqualified_{{$keys}}" class="hidden">
                                    <td class="hidden px-6 py-4 whitespace-nowrap">

                                        <x-jet-input class="hidden"
                                                     name="selectedFields[{{ $keys }}][id]"
                                                     wire:model="selectedFields.{{ $keys }}.id"
                                        />
                                    </td>
                                    <td class="hidden px-6 py-4 whitespace-nowrap">
                                        <x-jet-input class="hidden"
                                                     id="selectedParentIdFields_{{ $keys }}"
                                                     name="selectedFields[{{ $keys }}][parent_id]"
                                                     wire:model="selectedFields.{{ $keys }}.parent_id" />
                                        <x-jet-input-error for="selectedFields.{{ $keys }}.parent_id" class="mt-2" />
                                    </td>
                                    <td class="hidden px-6 py-4 whitespace-nowrap">
                                        <x-jet-input class="hidden"
                                                     id="selectedParentUUIDFields_{{ $keys }}"
                                                     name="selectedFields[{{ $keys }}][parent_uuid]"
                                                     wire:model="selectedFields.{{ $keys }}.parent_uuid" />
                                        <x-jet-input-error for="selectedFields.{{ $keys }}.parent_uuid" class="mt-2" />
                                    </td>
                                    <td class="hidden px-6 py-4 whitespace-nowrap">
                                        <x-jet-input class="hidden"
                                                     id="selectedParentTableNameFields_{{ $keys }}"
                                                     name="selectedFields[{{ $keys }}][parent_table_name]"
                                                     wire:model="selectedFields.{{ $keys }}.parent_table_name" />
                                        <x-jet-input-error for="selectedFields.{{ $keys }}.parent_table_name" class="mt-2" />
                                    </td>
                                    <td class="hidden px-6 py-4 whitespace-nowrap">
                                        <x-jet-input class="hidden"
                                                     id="selectedCriteriaTypeFields_{{ $keys }}"
                                                     name="selectedFields[{{ $keys }}][criteria_type]"
                                                     wire:model="selectedFields.{{ $keys }}.criteria_type" />
                                        <x-jet-input-error for="selectedFields.{{ $keys }}.criteria_type" class="mt-2" />
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($keys != 0)
                                            <div class="flex items-center">
                                                <div class="relative inline-flex">
                                                    <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>

                                                    <select
                                                        id="selectedCriteriaConditionFields_{{ $keys }}"
                                                        name="selectedFields[{{ $keys }}][criteria_condition]"
                                                        wire:model="selectedFields.{{ $keys }}.criteria_condition"
                                                        class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 w-35 bg-white hover:border-gray-400 focus:outline-none appearance-none">
                                                        <option value="">Choose your Condition</option>
                                                        <option value="and">And</option>
                                                        <option value="or">Or</option>
                                                    </select>
                                                </div>
                                            </div>
                                        @else
                                            <div class="hidden flex items-center">
                                                <div class="hidden relative inline-flex">
                                                    <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>

                                                    <select
                                                        id="selectedCriteriaConditionFields_{{ $keys }}"
                                                        name="selectedFields[{{ $keys }}][criteria_condition]"
                                                        wire:model="selectedFields.{{ $keys }}.criteria_condition"
                                                        class="hidden border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 w-35 bg-white hover:border-gray-400 focus:outline-none appearance-none">
                                                        <option value="and" selected>And</option>
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                        <x-jet-input-error for="selectedFields.{{ $keys }}.criteria_condition" class="mt-2" />

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="relative inline-flex">
                                                <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>

                                                <select
                                                    id="selectedHeaderFields_{{ $keys }}"
                                                    name="selectedFields[{{ $keys }}][criteria_field]"
                                                    wire:model="selectedFields.{{ $keys }}.criteria_field"
                                                    class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 w-72 bg-white hover:border-gray-400 focus:outline-none appearance-none">
                                                    <option value=""><p class="w-2 md:break-all">Choose a your field</p></option>
                                                    @foreach($allFields as $index => $field)
                                                        <option class="" value="{{ $index }}"><p class="w-2 md:break-all">{{ $field }}</p></option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <x-jet-input-error for="selectedFields.{{ $keys }}.criteria_field" class="mt-2" />
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="relative inline-flex">
                                                <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>

                                                <select
                                                    id="selectedCriteriaOperatorFields_{{ $keys }}"
                                                    name="selectedFields[{{ $keys }}][criteria_operator]"
                                                    wire:model="selectedFields.{{ $keys }}.criteria_operator"
                                                    class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 w-50 bg-white hover:border-gray-400 focus:outline-none appearance-none">
                                                    <option value="">Choose your Operators</option>
                                                    <option value="!=">Not Equal to</option>
                                                    <option value=">">Not Less Than</option>
                                                    <option value="=>">Not Less Than or Equal</option>
                                                    <option value="<">Not Greater Than</option>
                                                    <option value="<=">Not Greater Than or Equal</option>
                                                    <option value="NOT BETWEEN">Not Between</option>
                                                    <option value="NOT IN">Not In</option>
                                                    <option value="NOT NULL">Not Null</option>
                                                </select>
                                            </div>
                                        </div>
                                        <x-jet-input-error for="selectedFields.{{ $keys }}.criteria_operator" class="mt-2" />
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <x-jet-input
                                            id="selectedInputFields_{{ $keys }}"
                                            name="selectedFields[{{ $keys }}][criteria_value]"
                                            class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none"
                                            :value="old('selectedFields.{{ $keys }}.criteria_value')"
                                            wire:model="selectedFields.{{ $keys }}.criteria_value" />
                                        <x-jet-input-error for="selectedFields.{{ $keys }}.criteria_value" class="mt-2" />
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <x-jet-button id="editField_{{ $keys }}" wire:click.prevent="editField({{ $keys }}, {{ $selectedField['id'] }})" class="bg-blue-600 hover:bg-blue-500 focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600" wire:loading.attr="disabled">
                                            <svg enable-background="new 0 0 512 512" height="20" viewBox="0 0 512 512" width="20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="m370.589844 250.972656c-5.523438 0-10 4.476563-10 10v88.789063c-.019532 16.5625-13.4375 29.984375-30 30h-280.589844c-16.5625-.015625-29.980469-13.4375-30-30v-260.589844c.019531-16.558594 13.4375-29.980469 30-30h88.789062c5.523438 0 10-4.476563 10-10 0-5.519531-4.476562-10-10-10h-88.789062c-27.601562.03125-49.96875 22.398437-50 50v260.59375c.03125 27.601563 22.398438 49.96875 50 50h280.589844c27.601562-.03125 49.96875-22.398437 50-50v-88.792969c0-5.523437-4.476563-10-10-10zm0 0"/>
                                                <path d="m376.628906 13.441406c-17.574218-17.574218-46.066406-17.574218-63.640625 0l-178.40625 178.40625c-1.222656 1.222656-2.105469 2.738282-2.566406 4.402344l-23.460937 84.699219c-.964844 3.472656.015624 7.191406 2.5625 9.742187 2.550781 2.546875 6.269531 3.527344 9.742187 2.566406l84.699219-23.464843c1.664062-.460938 3.179687-1.34375 4.402344-2.566407l178.402343-178.410156c17.546875-17.585937 17.546875-46.054687 0-63.640625zm-220.257812 184.90625 146.011718-146.015625 47.089844 47.089844-146.015625 146.015625zm-9.40625 18.875 37.621094 37.625-52.039063 14.417969zm227.257812-142.546875-10.605468 10.605469-47.09375-47.09375 10.609374-10.605469c9.761719-9.761719 25.589844-9.761719 35.351563 0l11.738281 11.734375c9.746094 9.773438 9.746094 25.589844 0 35.359375zm0 0"/>
                                            </svg>
                                        </x-jet-button>

                                        <x-jet-button id="deletedField_{{ $keys }}" wire:click.prevent="deletedField({{ $keys }}, {{ $selectedField['id'] }})" class="bg-red-600 hover:bg-red-500 focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600" wire:loading.attr="disabled">
                                            <svg id="Layer_1" style="fill: white;" enable-background="new 0 0 512 512" height="20" viewBox="0 0 512 512" width="20" xmlns="http://www.w3.org/2000/svg">
                                                <g>
                                                    <path d="m424 64h-88v-16c0-26.467-21.533-48-48-48h-64c-26.467 0-48 21.533-48 48v16h-88c-22.056 0-40 17.944-40 40v56c0 8.836 7.164 16 16 16h8.744l13.823 290.283c1.221 25.636 22.281 45.717 47.945 45.717h242.976c25.665 0 46.725-20.081 47.945-45.717l13.823-290.283h8.744c8.836 0 16-7.164 16-16v-56c0-22.056-17.944-40-40-40zm-216-16c0-8.822 7.178-16 16-16h64c8.822 0 16 7.178 16 16v16h-96zm-128 56c0-4.411 3.589-8 8-8h336c4.411 0 8 3.589 8 8v40c-4.931 0-331.567 0-352 0zm313.469 360.761c-.407 8.545-7.427 15.239-15.981 15.239h-242.976c-8.555 0-15.575-6.694-15.981-15.239l-13.751-288.761h302.44z"/>
                                                    <path d="m256 448c8.836 0 16-7.164 16-16v-208c0-8.836-7.164-16-16-16s-16 7.164-16 16v208c0 8.836 7.163 16 16 16z"/>
                                                    <path d="m336 448c8.836 0 16-7.164 16-16v-208c0-8.836-7.164-16-16-16s-16 7.164-16 16v208c0 8.836 7.163 16 16 16z"/>
                                                    <path d="m176 448c8.836 0 16-7.164 16-16v-208c0-8.836-7.164-16-16-16s-16 7.164-16 16v208c0 8.836 7.163 16 16 16z"/>
                                                </g>
                                            </svg>
                                        </x-jet-button>
                                    </td>
                                </tr>

                                {{-- Here ends Childs --}}

                            @elseif($selectedFields[$keys]['criteria_group_level'] === 0)

                                {{-- Here starts Parend --}}

                                <tr id="unqualified_{{$keys}}">
                                    <td class="hidden px-6 py-4 whitespace-nowrap">

                                        <x-jet-input class="hidden"
                                                     name="selectedFields[{{ $keys }}][id]"
                                                     wire:model="selectedFields.{{ $keys }}.id"
                                        />
                                    </td>
                                    <td class="hidden px-6 py-4 whitespace-nowrap">
                                        <x-jet-input class="hidden"
                                                     id="selectedParentIdFields_{{ $keys }}"
                                                     name="selectedFields[{{ $keys }}][parent_id]"
                                                     wire:model="selectedFields.{{ $keys }}.parent_id" />
                                        <x-jet-input-error for="selectedFields.{{ $keys }}.parent_id" class="mt-2" />
                                    </td>
                                    <td class="hidden px-6 py-4 whitespace-nowrap">
                                        <x-jet-input class="hidden"
                                                     id="selectedParentUUIDFields_{{ $keys }}"
                                                     name="selectedFields[{{ $keys }}][parent_uuid]"
                                                     wire:model="selectedFields.{{ $keys }}.parent_uuid" />
                                        <x-jet-input-error for="selectedFields.{{ $keys }}.parent_uuid" class="mt-2" />
                                    </td>
                                    <td class="hidden px-6 py-4 whitespace-nowrap">
                                        <x-jet-input class="hidden"
                                                     id="selectedParentTableNameFields_{{ $keys }}"
                                                     name="selectedFields[{{ $keys }}][parent_table_name]"
                                                     wire:model="selectedFields.{{ $keys }}.parent_table_name" />
                                        <x-jet-input-error for="selectedFields.{{ $keys }}.parent_table_name" class="mt-2" />
                                    </td>
                                    <td class="hidden px-6 py-4 whitespace-nowrap">
                                        <x-jet-input class="hidden"
                                                     id="selectedCriteriaTypeFields_{{ $keys }}"
                                                     name="selectedFields[{{ $keys }}][criteria_type]"
                                                     wire:model="selectedFields.{{ $keys }}.criteria_type" />
                                        <x-jet-input-error for="selectedFields.{{ $keys }}.criteria_type" class="mt-2" />
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($keys != 0)
                                            <div class="flex items-center">
                                                <div class="relative inline-flex">
                                                    <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>

                                                    <select
                                                        id="selectedCriteriaConditionFields_{{ $keys }}"
                                                        name="selectedFields[{{ $keys }}][criteria_condition]"
                                                        wire:model="selectedFields.{{ $keys }}.criteria_condition"
                                                        class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 w-35 bg-white hover:border-gray-400 focus:outline-none appearance-none">
                                                        <option value="">Choose your Condition</option>
                                                        <option value="and">And</option>
                                                        <option value="or">Or</option>
                                                    </select>

                                                </div>
                                            </div>
                                        @else
                                            <div class="hidden flex items-center">
                                                <div class="hidden relative inline-flex">
                                                    <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>

                                                    <select
                                                        id="selectedCriteriaConditionFields_{{ $keys }}"
                                                        name="selectedFields[{{ $keys }}][criteria_condition]"
                                                        wire:model="selectedFields.{{ $keys }}.criteria_condition"
                                                        class="hidden border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 w-35 bg-white hover:border-gray-400 focus:outline-none appearance-none">
                                                        <option value="and" selected>And</option>
                                                    </select>

                                                </div>
                                            </div>
                                        @endif
                                        <x-jet-input-error for="selectedFields.{{ $keys }}.criteria_condition" class="mt-2" />

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
{{--                                        <div class="flex items-center">--}}
{{--                                            <div class="relative inline-flex">--}}
{{--                                                <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>--}}

{{--                                                <select--}}
{{--                                                    id="selectedHeaderFields_{{ $keys }}"--}}
{{--                                                    name="selectedFields[{{ $keys }}][criteria_field]"--}}
{{--                                                    wire:model="selectedFields.{{ $keys }}.criteria_field"--}}
{{--                                                    class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 w-72 bg-white hover:border-gray-400 focus:outline-none appearance-none">--}}
{{--                                                    <option value=""><p class="w-2 md:break-all">Choose a your field</p></option>--}}
{{--                                                    @foreach($allFields as $index => $field)--}}
{{--                                                        <option class="" value="{{ $index }}"><p class="w-2 md:break-all">{{ $field }}</p></option>--}}
{{--                                                    @endforeach--}}
{{--                                                </select>--}}

{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <x-jet-input-error for="selectedFields.{{ $keys }}.criteria_field" class="mt-2" />--}}
                                        <x-jet-label value="{{ __($selectedFields[$keys]['criteria_field']) }}" />
                                        <x-jet-input-error for="selectedFields.{{ $keys }}.criteria_field" class="mt-2" />
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="relative inline-flex">
                                                <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>

                                                <select
                                                    id="selectedCriteriaOperatorFields_{{ $keys }}"
                                                    name="selectedFields[{{ $keys }}][criteria_operator]"
                                                    wire:model="selectedFields.{{ $keys }}.criteria_operator"
                                                    class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 w-50 bg-white hover:border-gray-400 focus:outline-none appearance-none">
                                                    <option value="GROUP" selected>Group</option>
                                                </select>

                                            </div>
                                        </div>
                                        <x-jet-input-error for="selectedFields.{{ $keys }}.criteria_operator" class="mt-2" />
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <x-jet-label value="{{ __($selectedFields[$keys]['criteria_value']) }}" />
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <x-jet-button id="deletedField_{{ $keys }}" wire:click.prevent="deletedField({{ $keys }}, {{ $selectedField['id'] }})" class="bg-red-600 hover:bg-red-500 focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600" wire:loading.attr="disabled">
                                            <svg id="Layer_1" style="fill: white;" enable-background="new 0 0 512 512" height="20" viewBox="0 0 512 512" width="20" xmlns="http://www.w3.org/2000/svg">
                                                <g>
                                                    <path d="m424 64h-88v-16c0-26.467-21.533-48-48-48h-64c-26.467 0-48 21.533-48 48v16h-88c-22.056 0-40 17.944-40 40v56c0 8.836 7.164 16 16 16h8.744l13.823 290.283c1.221 25.636 22.281 45.717 47.945 45.717h242.976c25.665 0 46.725-20.081 47.945-45.717l13.823-290.283h8.744c8.836 0 16-7.164 16-16v-56c0-22.056-17.944-40-40-40zm-216-16c0-8.822 7.178-16 16-16h64c8.822 0 16 7.178 16 16v16h-96zm-128 56c0-4.411 3.589-8 8-8h336c4.411 0 8 3.589 8 8v40c-4.931 0-331.567 0-352 0zm313.469 360.761c-.407 8.545-7.427 15.239-15.981 15.239h-242.976c-8.555 0-15.575-6.694-15.981-15.239l-13.751-288.761h302.44z"/>
                                                    <path d="m256 448c8.836 0 16-7.164 16-16v-208c0-8.836-7.164-16-16-16s-16 7.164-16 16v208c0 8.836 7.163 16 16 16z"/>
                                                    <path d="m336 448c8.836 0 16-7.164 16-16v-208c0-8.836-7.164-16-16-16s-16 7.164-16 16v208c0 8.836 7.163 16 16 16z"/>
                                                    <path d="m176 448c8.836 0 16-7.164 16-16v-208c0-8.836-7.164-16-16-16s-16 7.164-16 16v208c0 8.836 7.163 16 16 16z"/>
                                                </g>
                                            </svg>
                                        </x-jet-button>

                                        <x-jet-button id="editField_{{ $keys }}" wire:click.prevent="$emitTo('selection-filter-groups','editData', {{ $keys }}, {{ $selectedField['id'] }}, '{{ $selectedField['criteria_group_uuid'] }}')" class="bg-blue-50 hover:bg-gray-50 focus:border-white-700 focus:ring focus:ring-blue-200 active:bg-white-600" wire:loading.attr="disabled">
                                            <svg enable-background="new 0 0 512 512" height="20" viewBox="0 0 512 512" width="20" xmlns="http://www.w3.org/2000/svg">
                                                <g>
                                                    <path d="m370.589844 250.972656c-5.523438 0-10 4.476563-10 10v88.789063c-.019532 16.5625-13.4375 29.984375-30 30h-280.589844c-16.5625-.015625-29.980469-13.4375-30-30v-260.589844c.019531-16.558594 13.4375-29.980469 30-30h88.789062c5.523438 0 10-4.476563 10-10 0-5.519531-4.476562-10-10-10h-88.789062c-27.601562.03125-49.96875 22.398437-50 50v260.59375c.03125 27.601563 22.398438 49.96875 50 50h280.589844c27.601562-.03125 49.96875-22.398437 50-50v-88.792969c0-5.523437-4.476563-10-10-10zm0 0"/>
                                                    <path d="m376.628906 13.441406c-17.574218-17.574218-46.066406-17.574218-63.640625 0l-178.40625 178.40625c-1.222656 1.222656-2.105469 2.738282-2.566406 4.402344l-23.460937 84.699219c-.964844 3.472656.015624 7.191406 2.5625 9.742187 2.550781 2.546875 6.269531 3.527344 9.742187 2.566406l84.699219-23.464843c1.664062-.460938 3.179687-1.34375 4.402344-2.566407l178.402343-178.410156c17.546875-17.585937 17.546875-46.054687 0-63.640625zm-220.257812 184.90625 146.011718-146.015625 47.089844 47.089844-146.015625 146.015625zm-9.40625 18.875 37.621094 37.625-52.039063 14.417969zm227.257812-142.546875-10.605468 10.605469-47.09375-47.09375 10.609374-10.605469c9.761719-9.761719 25.589844-9.761719 35.351563 0l11.738281 11.734375c9.746094 9.773438 9.746094 25.589844 0 35.359375zm0 0"/>
                                                </g>
                                            </svg>
                                        </x-jet-button>
                                    </td>
                                </tr>

                                {{-- Here end Parent --}}

                            @endif

                        @else

                            {{-- Here starts rest --}}

                            <tr id="unqualified_{{$keys}}">
                                <td class="hidden px-6 py-4 whitespace-nowrap">

                                    <x-jet-input class="hidden"
                                                 name="selectedFields[{{ $keys }}][id]"
                                                 wire:model="selectedFields.{{ $keys }}.id"
                                    />
                                </td>
                                <td class="hidden px-6 py-4 whitespace-nowrap">
                                    <x-jet-input class="hidden"
                                                 id="selectedParentIdFields_{{ $keys }}"
                                                 name="selectedFields[{{ $keys }}][parent_id]"
                                                 wire:model="selectedFields.{{ $keys }}.parent_id" />
                                    <x-jet-input-error for="selectedFields.{{ $keys }}.parent_id" class="mt-2" />
                                </td>
                                <td class="hidden px-6 py-4 whitespace-nowrap">
                                    <x-jet-input class="hidden"
                                                 id="selectedParentUUIDFields_{{ $keys }}"
                                                 name="selectedFields[{{ $keys }}][parent_uuid]"
                                                 wire:model="selectedFields.{{ $keys }}.parent_uuid" />
                                    <x-jet-input-error for="selectedFields.{{ $keys }}.parent_uuid" class="mt-2" />
                                </td>
                                <td class="hidden px-6 py-4 whitespace-nowrap">
                                    <x-jet-input class="hidden"
                                                 id="selectedParentTableNameFields_{{ $keys }}"
                                                 name="selectedFields[{{ $keys }}][parent_table_name]"
                                                 wire:model="selectedFields.{{ $keys }}.parent_table_name" />
                                    <x-jet-input-error for="selectedFields.{{ $keys }}.parent_table_name" class="mt-2" />
                                </td>
                                <td class="hidden px-6 py-4 whitespace-nowrap">
                                    <x-jet-input class="hidden"
                                                 id="selectedCriteriaTypeFields_{{ $keys }}"
                                                 name="selectedFields[{{ $keys }}][criteria_type]"
                                                 wire:model="selectedFields.{{ $keys }}.criteria_type" />
                                    <x-jet-input-error for="selectedFields.{{ $keys }}.criteria_type" class="mt-2" />
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($keys != 0)
                                        <div class="flex items-center">
                                            <div class="relative inline-flex">
                                                <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>

                                                <select
                                                    id="selectedCriteriaConditionFields_{{ $keys }}"
                                                    name="selectedFields[{{ $keys }}][criteria_condition]"
                                                    wire:model="selectedFields.{{ $keys }}.criteria_condition"
                                                    class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 w-35 bg-white hover:border-gray-400 focus:outline-none appearance-none">
                                                    <option value="">Choose your Condition</option>
                                                    <option value="and">And</option>
                                                    <option value="or">Or</option>
                                                </select>
                                            </div>
                                        </div>
                                    @else
                                        <div class="hidden flex items-center">
                                            <div class="hidden relative inline-flex">
                                                <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>

                                                <select
                                                    id="selectedCriteriaConditionFields_{{ $keys }}"
                                                    name="selectedFields[{{ $keys }}][criteria_condition]"
                                                    wire:model="selectedFields.{{ $keys }}.criteria_condition"
                                                    class="hidden border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 w-35 bg-white hover:border-gray-400 focus:outline-none appearance-none">
                                                    <option value="and" selected>And</option>
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                    <x-jet-input-error for="selectedFields.{{ $keys }}.criteria_condition" class="mt-2" />

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>

                                            <select
                                                id="selectedHeaderFields_{{ $keys }}"
                                                name="selectedFields[{{ $keys }}][criteria_field]"
                                                wire:model="selectedFields.{{ $keys }}.criteria_field"
                                                class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 w-72 bg-white hover:border-gray-400 focus:outline-none appearance-none">
                                                <option value=""><p class="w-2 md:break-all">Choose a your field</p></option>
                                                @foreach($allFields as $index => $field)
                                                    <option class="" value="{{ $index }}"><p class="w-2 md:break-all">{{ $field }}</p></option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <x-jet-input-error for="selectedFields.{{ $keys }}.criteria_field" class="mt-2" />
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>

                                            <select
                                                id="selectedCriteriaOperatorFields_{{ $keys }}"
                                                name="selectedFields[{{ $keys }}][criteria_operator]"
                                                wire:model="selectedFields.{{ $keys }}.criteria_operator"
                                                class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 w-50 bg-white hover:border-gray-400 focus:outline-none appearance-none">
                                                <option value="">Choose your Operators</option>
                                                <option value="!=">Not Equal to</option>
                                                <option value=">">Not Less Than</option>
                                                <option value="=>">Not Less Than or Equal</option>
                                                <option value="<">Not Greater Than</option>
                                                <option value="<=">Not Greater Than or Equal</option>
                                                <option value="NOT BETWEEN">Not Between</option>
                                                <option value="NOT IN">Not In</option>
                                                <option value="NOT NULL">Not Null</option>
                                            </select>
                                        </div>
                                    </div>
                                    <x-jet-input-error for="selectedFields.{{ $keys }}.criteria_operator" class="mt-2" />
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <x-jet-input
                                        id="selectedInputFields_{{ $keys }}"
                                        name="selectedFields[{{ $keys }}][criteria_value]"
                                        class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none"
                                        :value="old('selectedFields.{{ $keys }}.criteria_value')"
                                        wire:model="selectedFields.{{ $keys }}.criteria_value" />
                                    <x-jet-input-error for="selectedFields.{{ $keys }}.criteria_value" class="mt-2" />
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <x-jet-button id="deletedField_{{ $keys }}" wire:click.prevent="deletedField({{ $keys }}, {{ $selectedField['id'] }})" class="bg-red-600 hover:bg-red-500 focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600" wire:loading.attr="disabled">
                                        <svg id="Layer_1" style="fill: white;" enable-background="new 0 0 512 512" height="20" viewBox="0 0 512 512" width="20" xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <path d="m424 64h-88v-16c0-26.467-21.533-48-48-48h-64c-26.467 0-48 21.533-48 48v16h-88c-22.056 0-40 17.944-40 40v56c0 8.836 7.164 16 16 16h8.744l13.823 290.283c1.221 25.636 22.281 45.717 47.945 45.717h242.976c25.665 0 46.725-20.081 47.945-45.717l13.823-290.283h8.744c8.836 0 16-7.164 16-16v-56c0-22.056-17.944-40-40-40zm-216-16c0-8.822 7.178-16 16-16h64c8.822 0 16 7.178 16 16v16h-96zm-128 56c0-4.411 3.589-8 8-8h336c4.411 0 8 3.589 8 8v40c-4.931 0-331.567 0-352 0zm313.469 360.761c-.407 8.545-7.427 15.239-15.981 15.239h-242.976c-8.555 0-15.575-6.694-15.981-15.239l-13.751-288.761h302.44z"/>
                                                <path d="m256 448c8.836 0 16-7.164 16-16v-208c0-8.836-7.164-16-16-16s-16 7.164-16 16v208c0 8.836 7.163 16 16 16z"/>
                                                <path d="m336 448c8.836 0 16-7.164 16-16v-208c0-8.836-7.164-16-16-16s-16 7.164-16 16v208c0 8.836 7.163 16 16 16z"/>
                                                <path d="m176 448c8.836 0 16-7.164 16-16v-208c0-8.836-7.164-16-16-16s-16 7.164-16 16v208c0 8.836 7.163 16 16 16z"/>
                                            </g>
                                        </svg>
                                    </x-jet-button>
                                </td>
                            </tr>

                            {{-- Here end rest --}}

                        @endif

                    @endforeach
                    </tbody>
                </table>
                <div class="flex flex-row space-x-4 space-x mt-2 mb-2">
                    <x-jet-button id="addField" name="addField" wire:click.prevent="addField" class="ml-2 bg-blue-400" wire:loading.attr="disabled">
                        {{ __('+ Add New Field') }}
                    </x-jet-button>

                    <x-jet-button id="addGroup" name="addGroup" wire:click.prevent="$emit('openGroupModal')" class="ml-2 bg-yellow-500" wire:loading.attr="disabled">
                        {{ __('+ Add New Group') }}
                    </x-jet-button>
                </div>
            </div>

        </div>
    </div>
</div>

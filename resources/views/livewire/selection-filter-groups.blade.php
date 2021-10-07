<div>
    <div class="shadow overflow-hidden sm:rounded-md">
        <x-jet-button id="addField" name="addField" wire:click.prevent="addGroupField" class="ml-2 bg-yellow-500 ml-8 mt-4" wire:loading.attr="disabled">
            {{ __('+ Add New Group Field') }}
        </x-jet-button>
        <div class="px-4 py-5 bg-white sm:p-6">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-2 sm:col-span-2">
                    <x-jet-label for="group_id" class="block text-sm font-medium text-gray-700">Group ID</x-jet-label>
                    <x-jet-input type="text" wire:model="group_id" id="group_id" autocomplete="group_id" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" readonly/>
                    <x-jet-input-error for="group_id" class="mt-2" />
                </div>

                <div class="col-span-2 sm:col-span-2">
                    <x-jet-label for="criteria_group_name" class="block text-sm font-medium text-gray-700">Group Name</x-jet-label>
                    <x-jet-input type="text" wire:model="criteria_group_name" id="criteria_group_name" autocomplete="criteria_group_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                    <x-jet-input-error for="criteria_group_name" class="mt-2" />
                </div>

                <div class="col-span-2 sm:col-span-2">
                    <x-jet-label for="criteria_condition" class="block text-sm font-medium text-gray-700">Group Condition</x-jet-label>
                    {{--                    @if($keys != 0)--}}
                    <div class="flex items-center">
                        <div class="relative inline-flex">
                            <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>

                            <select
                                id="criteria_condition"
                                name="criteria_condition"
                                wire:model="criteria_condition"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <option value="">Choose your Condition</option>
                                <option value="and">And</option>
                                <option value="or">Or</option>
                            </select>
                        </div>
                    </div>
                    {{--                    @else--}}
                    {{--                        <div class="hidden flex items-center">--}}
                    {{--                            <div class="hidden relative inline-flex">--}}
                    {{--                                <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>--}}

                    {{--                                <select--}}
                    {{--                                    id="selectedCriteriaConditionFields_{{ $keys }}"--}}
                    {{--                                    name="selectedFields[{{ $keys }}][criteria_condition]"--}}
                    {{--                                    wire:model="selectedFields.{{ $keys }}.criteria_condition"--}}
                    {{--                                    class="hidden mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">--}}
                    {{--                                    <option value="and" selected>And</option>--}}
                    {{--                                </select>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    @endif--}}
                    <x-jet-input-error for="criteria_condition" class="mt-2" />
                </div>

                <div class="hidden col-span-6">
                    <x-jet-label for="criteria_group_auto_name" class="block text-sm font-medium text-gray-700">Group Auto Name</x-jet-label>
                    <x-jet-input type="text" wire:model="criteria_group_auto_name" id="criteria_group_auto_name" autocomplete="criteria_group_auto_name" class="hidden mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" readonly/>
                    <x-jet-input-error for="criteria_group_auto_name" class="mt-2" />
                </div>

                <div class="hidden col-span-6 sm:col-span-6 lg:col-span-2">
                    <x-jet-label for="criteria_group_uuid" class="block text-sm font-medium text-gray-700">Group UUID</x-jet-label>
                    <x-jet-input type="text" wire:model="criteria_group_uuid" id="criteria_group_uuid" autocomplete="criteria_group_uuid" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" readonly/>
                    <x-jet-input-error for="criteria_group_uuid" class="mt-2" />
                </div>

                <div class="hidden col-span-6 sm:col-span-3 lg:col-span-2">
                    <x-jet-label for="criteria_group_level" class="block text-sm font-medium text-gray-700">Level</x-jet-label>
                    <x-jet-input type="text" wire:model="criteria_group_level" id="criteria_group_level" autocomplete="criteria_group_level" class="hidden mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" readonly/>
                    <x-jet-input-error for="criteria_group_level" class="mt-2" />
                </div>

                <div class="hidden col-span-6 sm:col-span-3 lg:col-span-2">
                    <x-jet-label for="criteria_group_type" class="block text-sm font-medium text-gray-700">Group Type</x-jet-label>
                    <x-jet-input type="text" wire:model="criteria_group_type" id="criteria_group_type" autocomplete="criteria_group_type" class="hidden mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" readonly/>
                    <x-jet-input-error for="criteria_group_type" class="mt-2" />
                </div>
            </div>
        </div>
        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            <div class="flex justify-start">
                <x-jet-button id="addField" name="addField" wire:click.prevent="addGroupField" class="ml-2 bg-yellow-500" wire:loading.attr="disabled">
                    {{ __('+ Add New Group Field') }}
                </x-jet-button>
            </div>
        </div>
    </div>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="hidden px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID
                            </th>
                            <th scope="col" class="hidden px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Group UUID
                            </th>
                            <th scope="col" class="hidden px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Group Type
                            </th>
                            <th scope="col" class="hidden px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Group Level
                            </th>
                            <th scope="col" class="hidden px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Group Name
                            </th>
                            <th scope="col" class="hidden px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Group Auto Name
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
                        @foreach($selectedGroupFields as $keys => $selectedGroupField)
                            <tr id="unqualified_{{$keys}}">
                                <td class="hidden px-6 py-4 whitespace-nowrap">
                                    <x-jet-input class="hidden"
                                                 name="selectedGroupFields[{{ $keys }}][id]"
                                                 wire:model="selectedGroupFields.{{ $keys }}.id"
                                    />
                                </td>
                                <td class="hidden px-6 py-4 whitespace-nowrap">
                                    <x-jet-input class="hidden"
                                                 id="selectedCriteriaTypeFields_{{ $keys }}"
                                                 name="selectedGroupFields[{{ $keys }}][criteria_group_uuid]"
                                                 wire:model="selectedGroupFields.{{ $keys }}.criteria_group_uuid" />
                                    <x-jet-input-error for="selectedGroupFields.{{ $keys }}.criteria_group_uuid" class="mt-2" />
                                </td>
                                <td class="hidden px-6 py-4 whitespace-nowrap">
                                    <x-jet-input class="hidden"
                                                 id="selectedCriteriaTypeFields_{{ $keys }}"
                                                 name="selectedGroupFields[{{ $keys }}][criteria_group_type]"
                                                 wire:model="selectedGroupFields.{{ $keys }}.criteria_group_type" />
                                    <x-jet-input-error for="selectedGroupFields.{{ $keys }}.criteria_group_type" class="mt-2" />
                                </td>
                                <td class="hidden px-6 py-4 whitespace-nowrap">
                                    <x-jet-input class="hidden"
                                                 id="selectedCriteriaTypeFields_{{ $keys }}"
                                                 name="selectedGroupFields[{{ $keys }}][criteria_group_level]"
                                                 wire:model="selectedGroupFields.{{ $keys }}.criteria_group_level" />
                                    <x-jet-input-error for="selectedGroupFields.{{ $keys }}.criteria_group_level" class="mt-2" />
                                </td>
                                <td class="hidden px-6 py-4 whitespace-nowrap">
                                    <x-jet-input class="hidden"
                                                 id="selectedCriteriaTypeFields_{{ $keys }}"
                                                 name="selectedGroupFields[{{ $keys }}][criteria_group_name]"
                                                 wire:model="selectedGroupFields.{{ $keys }}.criteria_group_name" />
                                    <x-jet-input-error for="selectedGroupFields.{{ $keys }}.criteria_group_name" class="mt-2" />
                                </td>
                                <td class="hidden px-6 py-4 whitespace-nowrap">
                                    <x-jet-input class="hidden"
                                                 id="selectedCriteriaTypeFields_{{ $keys }}"
                                                 name="selectedGroupFields[{{ $keys }}][criteria_group_auto_name]"
                                                 wire:model="selectedGroupFields.{{ $keys }}.criteria_group_auto_name" />
                                    <x-jet-input-error for="selectedGroupFields.{{ $keys }}.criteria_group_auto_name" class="mt-2" />
                                </td>
                                <td class="hidden px-6 py-4 whitespace-nowrap">
                                    <x-jet-input class="hidden"
                                                 id="selectedParentIdFields_{{ $keys }}"
                                                 name="selectedGroupFields[{{ $keys }}][parent_id]"
                                                 wire:model="selectedGroupFields.{{ $keys }}.parent_id" />
                                    <x-jet-input-error for="selectedGroupFields.{{ $keys }}.parent_id" class="mt-2" />
                                </td>
                                <td class="hidden px-6 py-4 whitespace-nowrap">
                                    <x-jet-input class="hidden"
                                                 id="selectedParentUUIDFields_{{ $keys }}"
                                                 name="selectedGroupFields[{{ $keys }}][parent_uuid]"
                                                 wire:model="selectedGroupFields.{{ $keys }}.parent_uuid" />
                                    <x-jet-input-error for="selectedGroupFields.{{ $keys }}.parent_uuid" class="mt-2" />
                                </td>
                                <td class="hidden px-6 py-4 whitespace-nowrap">
                                    <x-jet-input class="hidden"
                                                 id="selectedParentTableNameFields_{{ $keys }}"
                                                 name="selectedGroupFields[{{ $keys }}][parent_table_name]"
                                                 wire:model="selectedGroupFields.{{ $keys }}.parent_table_name" />
                                    <x-jet-input-error for="selectedGroupFields.{{ $keys }}.parent_table_name" class="mt-2" />
                                </td>
                                <td class="hidden px-6 py-4 whitespace-nowrap">
                                    <x-jet-input class="hidden"
                                                 id="selectedCriteriaTypeFields_{{ $keys }}"
                                                 name="selectedGroupFields[{{ $keys }}][criteria_type]"
                                                 wire:model="selectedGroupFields.{{ $keys }}.criteria_type" />
                                    <x-jet-input-error for="selectedGroupFields.{{ $keys }}.criteria_type" class="mt-2" />
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($keys != 0)
                                        <div class="flex items-center">
                                            <div class="relative inline-flex">
                                                <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>

                                                <select
                                                    id="selectedCriteriaConditionFields_{{ $keys }}"
                                                    name="selectedGroupFields[{{ $keys }}][criteria_condition]"
                                                    wire:model="selectedGroupFields.{{ $keys }}.criteria_condition"
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
                                                    name="selectedGroupFields[{{ $keys }}][criteria_condition]"
                                                    wire:model="selectedGroupFields.{{ $keys }}.criteria_condition"
                                                    class="hidden border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 w-35 bg-white hover:border-gray-400 focus:outline-none appearance-none">
                                                    <option value="and" selected>And</option>
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                    <x-jet-input-error for="selectedGroupFields.{{ $keys }}.criteria_condition" class="mt-2" />

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>

                                            <select
                                                id="selectedHeaderFields_{{ $keys }}"
                                                name="selectedGroupFields[{{ $keys }}][criteria_field]"
                                                wire:model="selectedGroupFields.{{ $keys }}.criteria_field"
                                                class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 w-72 bg-white hover:border-gray-400 focus:outline-none appearance-none">
                                                <option value=""><p class="w-2 md:break-all">Choose a your field</p></option>
                                                @foreach($allGroupFields as $index => $field)
                                                    <option class="" value="{{ $index }}"><p class="w-2 md:break-all">{{ $field }}</p></option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <x-jet-input-error for="selectedGroupFields.{{ $keys }}.criteria_field" class="mt-2" />
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>

                                            <select
                                                id="selectedCriteriaOperatorFields_{{ $keys }}"
                                                name="selectedGroupFields[{{ $keys }}][criteria_operator]"
                                                wire:model="selectedGroupFields.{{ $keys }}.criteria_operator"
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
                                    <x-jet-input-error for="selectedGroupFields.{{ $keys }}.criteria_operator" class="mt-2" />
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <x-jet-input
                                        id="selectedInputFields_{{ $keys }}"
                                        name="selectedGroupFields[{{ $keys }}][criteria_value]"
                                        class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none"
                                        :value="old('selectedGroupFields.{{ $keys }}.criteria_value')"
                                        wire:model="selectedGroupFields.{{ $keys }}.criteria_value" />
                                    <x-jet-input-error for="selectedGroupFields.{{ $keys }}.criteria_value" class="mt-2" />
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <x-jet-button id="deletedGroupField_{{ $keys }}" wire:click.prevent="deletedGroupField({{ $keys }}, {{ $selectedGroupField['id'] }})" class="bg-red-600 hover:bg-red-500 focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600" wire:loading.attr="disabled">
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

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

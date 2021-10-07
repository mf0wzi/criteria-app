<div class="min-w-screen min-h-screen bg-gray-200 flex items-center justify-center px-5 pt-5 pb-56" x-data="{switcher:translationSwitcher()}">
    <div class="w-full md:w-1/2 lg:w-1/3">
        <div class="w-full flex justify-end">
            <div class="relative pb-5" @click.away="switcher.menuToggle=false">
                <button class="bg-white text-gray-500 rounded shadow-lg py-2 pr-3 pl-5 focus:outline-none" @click.prevent="switcher.menuToggle=!switcher.menuToggle">
                    <span class="flag-icon w-6" :class="`flag-icon-${switcher.countries[switcher.selected].flag}`"></span> <i class="mdi mdi-chevron-down"></i>
                </button>
                <div class="bg-white text-gray-700 shadow-md rounded text-sm absolute mt-12 top-0 right-0 min-w-full w-48 z-30" x-show="switcher.menuToggle" x-transition:enter="transition ease duration-300 transform" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease duration-300 transform" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4">
                    <span class="absolute top-0 right-0 w-3 h-3 bg-white transform rotate-45 -mt-1 mr-3"></span>
                    <div class="bg-white overflow-auto rounded w-full relative z-10">
                        <ul class="list-reset">
                            <template x-for="(item, index) in switcher.countries">
                                <li>
                                    <a href="#" class="px-4 py-2 flex hover:bg-gray-100 no-underline hover:no-underline transition-colors duration-100" @click.prevent="switcher.menuToggle=false;switcher.selected=index;">
                                        <span class="inline-block mr-2 flag-icon" :class="'flag-icon-'+item.flag"></span>
                                        <span class="inline-block" x-text="item.label"></span>
                                        <template x-if="index==switcher.selected">
                                            <span class="ml-auto">
                                                <i class="mdi mdi-check"></i>
                                            </span>
                                        </template>
                                    </a>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full bg-white text-gray-700 rounded shadow-lg px-5 py-4">
            <span x-text="switcher.translations[switcher.countries[switcher.selected].lang]"></span>
        </div>
    </div>
</div>

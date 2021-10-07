<x-guest-layout>





            <div class="h-screen w-full flex justify-center items-center bg-gradient-to-tr from-blue-900 to-blue-500">
                <div class="bg-image w-full sm:w-1/2 md:w-9/12 lg:w-1/2 mx-3 md:mx-5 lg:mx-0 shadow-md flex flex-col md:flex-row items-center rounded z-10 overflow-hidden bg-center bg-cover bg-blue-600">
                    <div class="w-full md:w-1/2 flex flex-col justify-center items-center bg-opacity-25 bg-blue-600 backdrop">
                        <h1 class="text-3xl md:text-4xl font-extrabold text-white my-2 md:my-0">
                            HartDev
                        </h1>
                        <p class="mb-2 text-white hidden md:block font-mono">
                            search a new somethings
                        </p>
                    </div>
                    <div class="w-full md:w-1/2 flex flex-col items-center bg-white py-5 md:py-8 px-4">
                        <h3 class="mb-4 font-bold text-3xl flex items-center text-grey-500">
                            LOGIN
                        </h3>
                        <x-jet-validation-errors class="mb-4" />

                        @if (session('status'))
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('login') }}" class="px-3 flex flex-col justify-center items-center w-full gap-3">
                            @csrf
                            <div>
                                <x-jet-input id="email" placeholder="email.." class="px-4 py-2 w-full rounded border border-gray-300 shadow-sm text-base placeholder-gray-500 placeholder-opacity-50 focus:outline-none focus:border-blue-500" type="email" name="email" :value="old('email')" required autofocus />
                            </div>
{{--                            <input--}}
{{--                                type="email" placeholder="email.."--}}
{{--                                class="px-4 py-2 w-full rounded border border-gray-300 shadow-sm text-base placeholder-gray-500 placeholder-opacity-50 focus:outline-none focus:border-blue-500"--}}
{{--                            >--}}
                            <div class="mt-4">
                                <x-jet-input id="password" placeholder="password.." class="px-4 py-2 w-full rounded border border-gray-300 shadow-sm text-base placeholder-gray-500 placeholder-opacity-50 focus:outline-none focus:border-blue-500" type="password" name="password" required autocomplete="current-password" />
                            </div>
{{--                            <input--}}
{{--                                type="password" placeholder="password.."--}}
{{--                                class="px-4 py-2 w-full rounded border border-gray-300 shadow-sm text-base placeholder-gray-500 placeholder-opacity-50 focus:outline-none focus:border-blue-500"--}}
{{--                            >--}}
                            <div class="flex items-center justify-end mt-2">
                                <label for="remember_me" class="flex items-center">
                                    <x-jet-checkbox id="remember_me" name="remember" />
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                </label>
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                @if (Route::has('password.request'))
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif

                                <x-jet-button class="ml-4">
                                    {{ __('Log in') }}
                                </x-jet-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
</x-guest-layout>

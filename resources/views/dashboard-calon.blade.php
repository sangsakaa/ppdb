<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <x-button target="_blank" href="https://github.com/kamona-wd/kui-laravel-breeze" variant="black"
                class="justify-center max-w-xs gap-2">
                <x-icons.github class="w-6 h-6" aria-hidden="true" />
                <span>Star on Github</span>
            </x-button>
        </div>
    </x-slot>

    <div class=" grid grid-cols-2 sm:grid-cols-1 gap-2">
        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <div class=" grid grid-cols-1 sm:grid-cols-2 gap-2">

                <div>
                    <x-button
                        href="form-pendaftaran/{{$user_id}}"
                        variant="purple"
                        class="items-center max-w-xs gap-2">
                        <x-icons.add class="w-6 h-6" aria-hidden="true" />
                        <span>Formulir Pendaftaran</span>
                    </x-button>
                </div>
            </div>
        </div>
        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <div class=" grid grid-cols-1 sm:grid-cols-2 gap-2">

                





            </div>




        </div>
    </div>
</x-app-layout>
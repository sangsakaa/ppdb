<x-app-layout>
    <x-slot name="header">
        @section('title', ' | Form Permission' )
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
    <div class=" grid grid-cols-1  gap-3">
        <div class="p-4  overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <x-button
                href="/permission-management"
                variant="purple"
                class="items-center max-w-xs gap-2">
                <x-icons.arrow-back class="w-6 h-6" aria-hidden="true" />
                <span>Back</span>
            </x-button>
        </div>
        <div class="p-4  overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <form action="/add-permission-management" method="post">
                @csrf
                <div class=" flex gap-2">
                    <input type="text" name="guard_name" required class=" w-1/4 px-1 py-1  bg-transparent" placeholder="add-post">
                    <x-button
                        target="_blank"
                        type="submit"
                        variant="purple"
                        class="items-center max-w-xs gap-2">
                        <x-icons.add class="w-6 h-6" aria-hidden="true" />
                        <span>Permission</span>
                    </x-button>
                </div>
            </form>

        </div>

    </div>
</x-app-layout>
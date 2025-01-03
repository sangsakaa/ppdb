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
    <div class=" grid grid-cols-1  gap-3">
        <div class="p-4  overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <x-button
                href="/user-management"
                variant="purple"
                class="items-center max-w-xs gap-2">
                <x-icons.arrow-back class="w-6 h-6" aria-hidden="true" />
                <span>Back</span>
            </x-button>
            <x-button

                href="/add-role-management"
                variant="purple"
                class="items-center max-w-xs gap-2">
                <x-icons.add class="w-6 h-6" aria-hidden="true" />
                <span>Role</span>
            </x-button>
        </div>
        <div class="p-4  overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <table class="table border w-full">
                <thead>
                    <tr class=" border  bg-purple-500 text-white able-auto w-full border-collapse ">
                        <th class=" py-2">Nama</th>

                        <th>Guard Name</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                    <tr class="border py-1 hover:bg-purple-100">
                        <td class=" py-1 px-1">
                            <a href="/permission-role/{{$role->id}}">
                                {{ $role->name }}
                            </a>
                        </td>
                        <td class=" py-1 px-1 text-center">{{ $role->guard_name }}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

        </div>

    </div>
</x-app-layout>
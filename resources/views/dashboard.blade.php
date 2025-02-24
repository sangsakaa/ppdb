<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>

        </div>
    </x-slot>
    @if(auth()->user()->hasRole('administrator'))

    <div>
        @include('administrator.dasboard.administrator')
    </div>
    @elseif(auth()->user()->hasRole('calon_peserta'))
    <div>
        @include('administrator.dasboard.calon')
    </div>
    @elseif(!auth()->user()->roles->isNotEmpty())

    <div>
        @include('administrator.dasboard.norole')
    </div>

    @endif

</x-app-layout>
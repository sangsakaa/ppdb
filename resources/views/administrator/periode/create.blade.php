<x-app-layout>
    <x-slot name="header">
        @section('title', ' | Form Periode' )
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Form Periode') }}
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
                href="/management-periode-pendidikan"
                variant="purple"
                class="items-center max-w-xs gap-2">
                <x-icons.arrow-back class="w-6 h-6" aria-hidden="true" />
                <span>Back</span>
            </x-button>

        </div>
        <div class="p-4  overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <form action="/add-periode-pendidikan" method="post">
                @csrf
                <div class=" grid grid-cols-1 gap-1 ">
                    <div>
                        <input type="text" name="periode" @error('periode') is invalid @enderror value="{{old('periode')}}" class=" w-1/4 px-1 py-1  bg-transparent" placeholder="2024/2025">
                    </div>
                    @error('periode')
                    <small class=" text-sm  flex text-red-500">{{ $message }}</small>
                    @enderror
                    <input type="date" name="tanggal_mulai" required class=" w-1/4 px-1 py-1  bg-transparent" placeholder="2024/2025">

                    <div class=" py-4">
                        <input type="date" name="tanggal_akhir" required class=" w-1/4 px-1 py-1  bg-transparent" placeholder="2024/2025">
                    </div>
                    <select name="semester" id="" class=" w-1/4 py-1">
                        <option value="ganjil">Ganjil</option>
                        <option value="genap">Genap</option>
                    </select>
                    <x-button
                        target="_blank"
                        type="submit"
                        variant="purple"
                        class="items-center max-w-xs gap-2 w-1/4">
                        <x-icons.add class="w-6 h-6" aria-hidden="true" />
                        <span>Periode</span>
                    </x-button>
                </div>
            </form>

        </div>

    </div>
</x-app-layout>
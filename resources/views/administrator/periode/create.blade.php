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
    </div>
    <div class="p-4  overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <form action="/add-periode-pendidikan" method="post">
            @csrf
            <div class=" grid grid-cols-1 sm:grid-cols-2 sm gap-2">
                <div>
                    <label for="">Tahun Periode</label>
                    <input type="text" name="periode" @error('periode') is invalid @enderror value="{{old('periode')}}" class="  px-1 py-1  bg-transparent w-full" placeholder="2024/2025" required>
                    @error('periode')
                    <small class="text-sm flex text-red-500">{{ $message }}</small>
                    @else
                    <small class="text-sm flex text-gray-500">Masukkan periode dalam format YYYY</small>
                    @enderror
                </div>
                <div>
                    <label for="">Periode</label>
                    <select name="semester" id="" class=" w-full  py-1">
                        <option value="">Pilih Periode</option>
                        <option value="ganjil">Ganjil</option>
                        <option value="genap">Genap</option>
                    </select>
                    @error('periode')
                    <small class="text-sm flex text-red-500">{{ $message }}</small>
                    @else
                    <small class="text-sm flex text-gray-500">Masukkan periode dalam format YYYY</small>
                    @enderror
                </div>
                <div class=" w-full">
                    <label for="">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" required class=" w-full  px-1 py-1  bg-transparent" placeholder="2024/2025">
                    @error('periode')
                    <small class="text-sm flex text-red-500">{{ $message }}</small>
                    @else
                    <small class="text-sm flex text-gray-500">Masukkan periode dalam format YYYY</small>
                    @enderror
                </div>
                <div>
                    <label for="">Tanggal Berakhir</label>
                    <input type="date" name="tanggal_akhir" required class=" w-full  px-1 py-1  bg-transparent" placeholder="2024/2025">
                    @error('periode')
                    <small class="text-sm flex text-red-500">{{ $message }}</small>
                    @else
                    <small class="text-sm flex text-gray-500">Masukkan periode dalam format YYYY</small>
                    @enderror
                </div>

            </div>
            <div class=" py-2">
                <x-button
                    target="_blank"
                    type="submit"
                    variant="purple"
                    class="items-center max-w-xs gap-2 ">
                    <x-icons.add class="w-6 h-6" aria-hidden="true" />
                    <span>Periode</span>
                </x-button>
            </div>

        </form>
    </div>
</x-app-layout>
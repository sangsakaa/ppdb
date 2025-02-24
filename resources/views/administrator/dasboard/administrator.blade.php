<div>
  <div class=" grid grid-cols-1 gap-2">
    <!-- awal header -->
    <div>
      <div class="p-4 bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <div class="justify-center   p-2 rounded-md grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-3 xl:grid-cols-3">

          <div class=" bg-red-600 px-5 py-2 rounded-lg">
            <div class="flex justify-between">
              <span class="text-white py-4">
                {{$jumlahUser}}
              </span>
              <x-icons.users class=" text-white h-10 mt-2"></x-icons.users>
            </div>
          </div>
          <div class=" bg-yellow-500 px-5 py-2 rounded-lg">
            <div class="flex justify-between">
              <span class="text-white py-4">
                {{$jumlahUser}}
              </span>
              <x-icons.users class=" h-10 mt-2"></x-icons.users>
            </div>
          </div>
          <div class=" bg-blue-600 px-5 py-2 rounded-lg">
            <div class="flex justify-between">
              <span class="text-white py-4">
                {{$jumlahUser}}
              </span>
              <x-icons.users class=" text-white h-10 mt-2"></x-icons.users>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <!-- akhir header -->
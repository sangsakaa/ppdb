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
                href="/role-management"
                variant="purple"
                class="items-center max-w-xs gap-2">
                <x-icons.arrow-back class="w-6 h-6" aria-hidden="true" />
                <span>Role</span>
            </x-button>
            <x-button
                href="/permission-management"
                variant="purple"
                class="items-center max-w-xs gap-2">
                <x-icons.user-circle class="w-6 h-6" aria-hidden="true" />
                <span>Perimission</span>
            </x-button>
        </div>
        <div class="p-6  overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <div>
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

            </div>
            <table class="table border w-full">
                <thead>
                    <tr class=" border  bg-purple-500 text-white able-auto w-full border-collapse ">
                        <th class=" py-2">Nama</th>
                        <th>Guard</th>
                        <th>Permission Role Management</th>
                        <th>Approve Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $user)
                    <tr class="border py-1 hover:bg-purple-100">
                        <td class="px-1">{{ $user->name }}</td>
                        <td class="px-1">{{ $user->guard_name }}</td>
                        <form action="{{ route('permission-role', $user->id) }}" method="POST">
                            <td class="px-1 text-center">
                                @csrf
                                @method('PUT')
                                <input hidden type="text" name="model_id" value="{{$user->id}}">
                                <select name="permission_id" class=" py-1 px-1">
                                    @foreach($permissions as $permission)
                                    <option value="{{ $permission->id }}">{{ $permission->id }} - {{ $permission->name }}</option>
                                    @endforeach
                                </select>
        </div>
        </td>
        <td class="px-1 text-center">
            <button type="submit" class="btn btn-primary">Assign</button>
        </td>
        </form>
        </tr>
        @endforeach
        </tbody>
        </table>
    </div>
    <div class="p-6  overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <table class="table border w-full">
            <thead>
                <tr class=" border  bg-purple-500 text-white able-auto w-full border-collapse ">
                    <th class=" text-left px-1 py-2">Permission</th>
                    <th class=" text-left px-1 py-2">Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hasrole as $user)
                <tr class="border py-1 hover:bg-purple-100">
                    <td class="px-1">{{ $user->permission_name }}</td>
                    <td class="px-1">{{ $user->roles_name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-app-layout>
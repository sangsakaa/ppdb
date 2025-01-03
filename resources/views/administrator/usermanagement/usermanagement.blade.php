<x-app-layout>
    <x-slot name="header">
        @section('title', ' | User Management' )
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('User Management') }}
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
                <x-icons.user-circle class="w-6 h-6" aria-hidden="true" />
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
        <div class="p-4  overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
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
            <table class="table border w-full">
                <thead>
                    <tr class=" border  bg-purple-500 text-white able-auto w-full border-collapse ">
                        <th class=" py-2">Nama</th>
                        <th>Email</th>
                        <th>Role Management</th>
                        <th>Approve Role</th>
                        <th>Reset Password</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataUser as $user)
                    <tr class="border py-1 hover:bg-purple-100">
                        <td class="px-1">{{ $user->name }}</td>
                        <td class="px-1">{{ $user->email }}</td>
                        <form action="{{ route('assign.role', $user->id) }}" method="POST">
                            <td class="px-1 text-center">
                                @csrf
                                @method('PUT')
                                <form action="{{ route('assign.role', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <!-- <select name="role" class="py-1">
                                        <option value="" {{ !$user->roles->isEmpty() ? '' : 'selected' }}>Select Role</option>
                                        <option value="administrator" {{ $user->hasRole('administrator') ? 'selected' : '' }}>Administrator</option>
                                        <option value="calon_peserta" {{ $user->hasRole('calon_peserta') ? 'selected' : '' }}>Calon Peserta</option>
                                    </select> -->
                                    <select name="role" class="py-1">
                                        <option value="" {{ !$user->roles->isEmpty() ? '' : 'selected' }}>Select Role</option>
                                        @foreach ($roles as $role)
                                        <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                            {{ ucfirst($role->name) }}
                                        </option>
                                        @endforeach
                                    </select>
                            </td>
                            <td class=" px-1 text-center">
                                <button type="submit" class="btn btn-primary">
                                    Assign Role
                                </button>
                            </td>

                        </form>
                        <td class=" px-1 text-center">
                            <form action="/reset-password" method="post">
                                @csrf
                                <input type="hidden" name="email" value="{{$user->email}}">
                                <input type="hidden" name="password" value="{{$user->password}}">
                                <button class=" bg-slate-500 hover:bg-slate-300 px-2 py-1 text-white" type="submit" class="btn btn-primary">
                                    Reset Password
                                </button>
                            </form>
                        </td>

                    </tr>


                    @endforeach

                </tbody>
            </table>

        </div>

    </div>
</x-app-layout>
<x-perfect-scrollbar
    as="nav"
    aria-label="main"
    class="flex flex-col flex-1 gap-4 px-3">
    @can('view-post')
    <x-sidebar.link
        title="Dashboard"
        href="{{ route('dashboard') }}"
        :isActive="request()->routeIs('dashboard')">
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>
    <x-sidebar.link
        title="User Management"
        href="{{ route('user-management') }}"
        :isActive="request()->routeIs('user-management')">
        <x-slot name="icon">
            <x-icons.users class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.link
        title="Periode Management"
        href="{{ route('management-periode-pendidikan') }}"
        :isActive="request()->routeIs('management-periode-pendidikan')">
        <x-slot name="icon">
            <x-icons.date class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.dropdown
        title="Buttons"
        :active="Str::startsWith(request()->route()->uri(), 'buttons')">
        <x-slot name="icon">
            <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>

        <x-sidebar.sublink
            title="Text button"
            href="{{ route('buttons.text') }}"
            :active="request()->routeIs('buttons.text')" />
        <x-sidebar.sublink
            title="Icon button"
            href="{{ route('buttons.icon') }}"
            :active="request()->routeIs('buttons.icon')" />
        <x-sidebar.sublink
            title="Text with icon"
            href="{{ route('buttons.text-icon') }}"
            :active="request()->routeIs('buttons.text-icon')" />
    </x-sidebar.dropdown>
    <x-sidebar.link
        title="Daftar Calon "
        href="{{ route('daftar-calon-peserta') }}"
        :isActive="request()->routeIs('daftar-calon-peserta')">
        <x-slot name="icon">
            <x-icons.list class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>
    @endcan
    <div
        x-transition
        x-show="isSidebarOpen || isSidebarHovered"
        class="text-sm text-gray-500">
        <!-- Dummy Links -->
    </div>
    @role('calon_peserta')
    <x-sidebar.link
        title="Dashboard"
        href="{{ route('dashboard') }}"
        :isActive="request()->routeIs('dashboard')">
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>
    <x-sidebar.link
        title="Formulir"
        href="{{ route('dashboard-calon') }}"
        :isActive="request()->routeIs('dashboard-calon')">
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    @endrole
    <!-- @php
    $links = array_fill(0, 3, '');
    @endphp

    @foreach ($links as $index => $link)
    <x-sidebar.link title="Dummy link {{ $index + 1 }}" href="#" />
    @endforeach -->

</x-perfect-scrollbar>
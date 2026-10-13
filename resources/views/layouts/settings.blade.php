<link rel="stylesheet" href="{{ asset('css/custom.css') }}">

<div class="rounded-xl border border-gray-200 bg-white mt-5 ps-10 shadow-sm">

    <nav class="flex flex-wrap items-center"
        style="column-gap: 48px; row-gap: 16px;">

        {{-- General Settings --}}
        <a href="{{ route('settings.index') }}"
            @class([
                'settings-nav-link text-sm font-medium',
                'active' => request()->routeIs('settings.index'),
            ])>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.8"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M10.5 6h9.75M10.5 6a2.25 2.25 0 1 1-4.5 0m4.5 0a2.25 2.25 0 1 0-4.5 0M3.75 6h2.25m4.5 12h9.75m-9.75 0a2.25 2.25 0 1 1-4.5 0m4.5 0a2.25 2.25 0 1 0-4.5 0m-2.25 0H3.75m12-6h4.5m-4.5 0a2.25 2.25 0 1 1-4.5 0m4.5 0a2.25 2.25 0 1 0-4.5 0m-7.5 0h7.5" />
            </svg>
            <span>General Settings</span>
        </a>

        {{-- My Profile --}}
        <a href="{{ route('settings.profile.edit') }}"
            @class([
                'settings-nav-link text-sm font-medium',
                 'active' => request()->routeIs('settings.profile.*'),
            ])>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.8"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.1a7.5 7.5 0 0 1 15 0A17.9 17.9 0 0 1 12 21.75a17.9 17.9 0 0 1-7.5-1.65Z" />
            </svg>
            <span>My Profile</span>
        </a>

        {{-- Companies --}}
        <a href="{{ route('settings.user-companies.index') }}"
            @class([
                'settings-nav-link text-sm font-medium',
                'active' => request()->routeIs('settings.user-companies.*'),
            ])>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.8"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3.75 21h16.5M4.5 21V5.25A2.25 2.25 0 0 1 6.75 3h10.5a2.25 2.25 0 0 1 2.25 2.25V21M9 6.75h1.5m-1.5 3.75h1.5M9 14.25h1.5m3-7.5H15m-1.5 3.75H15m-1.5 3.75H15M10.5 21v-3.75h3V21" />
            </svg>
            <span>Companies</span>
        </a>

        {{-- Branches --}}
        <a href="{{ route('settings.branches.index') }}"
            @class([
                'settings-nav-link text-sm font-medium',
                'active' => request()->routeIs('settings.branches.*'),
            ])>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.8"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 10.5 4.5 4.5h15l1.5 6M4.5 10.5v9h15v-9M3 10.5a3 3 0 0 0 6 0 3 3 0 0 0 6 0 3 3 0 0 0 6 0M9 19.5v-5.25h6v5.25" />
            </svg>
            <span>Branches</span>
        </a>

        {{-- Users & Roles --}}
        <a href="{{ route('settings.users.index') }}"
            @class([
                'settings-nav-link text-sm font-medium',
                'active' => request()->routeIs('settings.users.*', 'settings.roles.*'),
            ])>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.8"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16.5 21v-2.25A4.5 4.5 0 0 0 12 14.25H6.75a4.5 4.5 0 0 0-4.5 4.5V21m7.125-10.5a3.375 3.375 0 1 0 0-6.75 3.375 3.375 0 0 0 0 6.75Zm6.375-6.375a3.375 3.375 0 0 1 0 6.375m2.625 3.75A4.5 4.5 0 0 1 22.5 18.75V21" />
            </svg>
            <span>Users &amp; Roles</span>
        </a>

        {{-- Recycle Bin --}}
        <a href="{{ url('/recyclebin') }}"
            @class([
                'settings-nav-link text-sm font-medium',
                'active' => request()->is('recyclebin'),
            ])>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.8"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3.75 6.75h16.5m-14.25 0 .75 13.5h10.5l.75-13.5M9.75 10.5v6m4.5-6v6M9 6.75V4.5h6v2.25" />
            </svg>
            <span>Recycle Bin</span>
        </a>

    </nav>
</div>
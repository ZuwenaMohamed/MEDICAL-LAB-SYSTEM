
{{-- Navigation and Branch Filter --}}
<div class="flex flex-wrap items-center justify-between gap-2 border-b border-gray-200">

    {{-- Navigation Buttons --}}
    <div class="flex flex-wrap items-center gap-2">

        {{-- Active Users --}}
        <a
            href="{{ route('settings.users.index') }}"
            style="{{ request()->routeIs('settings.users.index', 'settings.users.create', 'settings.users.show', 'settings.users.edit') ? 'border-bottom: 2px solid #1d4ed8; background-color: #eff6ff; color: #1e40af;' : 'border-bottom: 2px solid transparent;' }}"
            class="rounded-t-lg px-5 py-3 text-sm font-semibold transition hover:bg-blue-50"
        >
            <span class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2m6-10a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm7-3h5m-2.5-2.5v5" />
                </svg>
                Active Users
            </span>
        </a>

        {{-- Roles --}}
        <a
            href="{{ route('settings.roles.index') }}"
            style="{{ request()->routeIs('settings.roles.*') ? 'border-bottom: 2px solid #1d4ed8; background-color: #eff6ff; color: #1e40af;' : 'border-bottom: 2px solid transparent;' }}"
            class="rounded-t-lg px-5 py-3 text-sm font-semibold transition hover:bg-blue-50"
        >
            <span class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6m14 0a8 8 0 1 1-16 0 8 8 0 0 1 16 0Z" />
                </svg>
                Roles
            </span>
        </a>

        {{-- Inactive Users --}}
        <a
            href="{{ route('settings.users.inactive') }}"
            style="{{ request()->routeIs('settings.users.inactive') ? 'border-bottom: 2px solid #1d4ed8; background-color: #eff6ff; color: #1e40af;' : 'border-bottom: 2px solid transparent;' }}"
            class="rounded-t-lg px-5 py-3 text-sm font-semibold transition hover:bg-blue-50"
        >
            <span class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.5a3.5 3.5 0 0 0-3.5-3.5h-5A3.5 3.5 0 0 0 6 18.5V21h12v-2.5ZM12 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm8-6 3 3m0-3-3 3" />
                </svg>
                Inactive Users
            </span>
        </a>

    </div>

    {{-- Branch Filter: Always Visible --}}
    <form
        method="GET"
        action="{{ route('settings.users.index') }}"
        class="ml-auto py-2"
    >
        <select
            name="branch_id"
            onchange="this.form.submit()"
            class="w-64 rounded-md border-gray-300 bg-white text-sm text-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500"
            aria-label="Filter users by branch"
        >
            <option value="">All Branches</option>

            @foreach ($branches as $branch)
                <option
                    value="{{ $branch->id }}"
                    @selected((string) $selectedBranchId === (string) $branch->id)
                >
                    {{ $branch->name }} — {{ $branch->company?->name ?? 'No company' }}
                </option>
            @endforeach
        </select>
    </form>

</div>

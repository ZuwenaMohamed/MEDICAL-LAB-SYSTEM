<x-app-layout>
    @include('layouts.settings')
    <div class="mx-auto w-full max-w-6xl space-y-6 p-6">

        <div class="flex items-center justify-between">

            <div>
                <h1 class="text-2xl font-semibold text-gray-900">
                    Create New Role
                </h1>

                <p class="mt-1 text-sm text-gray-600">
                    Create a role and assign its permissions.
                </p>
            </div>

            <a
                href="{{ route('settings.roles.store') }}"
                class="inline-flex items-center justify-center rounded-lg px-3 py-2 text-gray-600 transition hover:bg-gray-100 hover:text-gray-900"
                title="Back to roles"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 19l-7-7 7-7"
                    />
                </svg>
            </a>

        </div>

        {{-- @if ($errors->any())
            <div class="rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                <ul class="list-inside list-disc space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        <form
            method="POST"
            action="{{ route('settings.roles.store') }}"
            class="space-y-6"
        >
            @csrf

            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">

                <label
                    for="name"
                    class="mb-2 block text-sm font-medium text-gray-700"
                >
                    Role Name
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="e.g. Laboratory Technician"
                    required
                    maxlength="255"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-900 outline-none transition focus:border-blue-600 focus:ring-2 focus:ring-blue-100"
                >

            </div>

            <div class="rounded-xl bg-white shadow-sm ring-1 ring-gray-200">

                <div class="border-b border-gray-200 px-6 py-4">

                    <h2 class="text-lg font-semibold text-gray-900">
                        Assign Permissions
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        Select the permissions this role should have.
                    </p>

                </div>

                <div class="columns-1 gap-x-px bg-white sm:columns-2 lg:columns-3">

                    @forelse ($features as $feature)

                        @if ($feature->permissions->isNotEmpty())

                            <div class="mb-px break-inside-avoid bg-white p-6">
                                <div class="mb-4 flex items-center gap-3">

                                    <input
                                        type="checkbox"
                                        class="feature-checkbox rounded border-gray-300 text-blue-700 focus:ring-blue-500"
                                        aria-label="Select all {{ $feature->name }} permissions"
                                        onchange="
                                            this.closest('.mb-px').querySelectorAll('.permission-checkbox')
                                                .forEach(checkbox => checkbox.checked = this.checked)
                                        "
                                    >

                                    <h3 class="text-sm font-semibold text-gray-900">
                                        {{ $feature->name }}
                                    </h3>

                                </div>

                                <div class="space-y-3">

                                    @foreach ($feature->permissions as $permission)

                                        <label
                                            for="permission-{{ $permission->id }}"
                                            class="flex cursor-pointer items-start gap-3 rounded-lg border border-gray-200 p-3 transition hover:border-blue-300 hover:bg-blue-50"
                                        >
                                            <input
                                                type="checkbox"
                                                id="permission-{{ $permission->id }}"
                                                name="permissions[]"
                                                value="{{ $permission->id }}"
                                                @checked(in_array(
                                                    $permission->id,
                                                    old('permissions', [])
                                                ))
                                                class="mt-0.5 permission-checkbox rounded border-gray-300 text-blue-700 outline-hidden focus:ring-3 focus:ring-blue-600"
                                            >

                                            <span class="text-sm text-gray-700">
                                                {{ $permission->display_name }}
                                            </span>

                                        </label>

                                    @endforeach

                                </div>

                            </div>

                        @endif

                    @empty

                        <div class="bg-white p-6 text-center text-sm text-gray-500">
                            No features or permissions are available.
                        </div>

                    @endforelse

                </div>

            </div>

            <div class="flex items-center justify-end gap-3">

                <a
                    href="{{ route('settings.roles.index') }}"
                    class="inline-flex items-center justify-center rounded-lg px-4 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-100"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-blue-800"
                >
                    Create Role
                </button>

            </div>

        </form>

    </div>

</x-app-layout>
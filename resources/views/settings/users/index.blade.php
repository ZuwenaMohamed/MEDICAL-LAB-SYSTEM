<x-app-layout>
    @include('layouts.settings')

    <div class="mt-5 p-6">
        <div class="mx-auto max-w-5xl overflow-hidden rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">

            @include('layouts.user-roles')

            {{-- Add User --}}
            @can('employees.create')
                <div class="flex justify-start border-b border-gray-300 p-1">
                    <a
                        href="{{ route('settings.users.create') }}"
                        class="inline-flex items-center gap-1 rounded-md bg-blue-700 px-6 py-2 text-sm font-semibold text-white transition hover:bg-blue-800"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Add User
                    </a>
                </div>
            @endcan

            <div class="overflow-x-auto">
                <table class="w-max min-w-full table-auto border-collapse text-left text-sm">

                    <thead class="border-b-2 border-black bg-white">
                        <tr>
                            <th class="whitespace-nowrap px-4 py-3 font-bold text-gray-900">
                                No.
                            </th>

                            <th class="whitespace-nowrap px-4 py-3 font-bold text-gray-900">
                                Employee No.
                            </th>

                            <th class="whitespace-nowrap px-4 py-3 font-bold text-gray-900">
                                Name
                            </th>

                            <th class="whitespace-nowrap px-4 py-3 font-bold text-gray-900">
                                Email
                            </th>

                            <th class="whitespace-nowrap px-4 py-3 font-bold text-gray-900">
                                Role
                            </th>

                            <th class="whitespace-nowrap px-4 py-3 text-left font-bold text-gray-900">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody class="border-b border-gray-500">
                        @forelse ($users as $user)
                            <tr class="{{ $loop->odd ? 'bg-gray-200' : 'bg-white' }}">

                                <td class="whitespace-nowrap px-4 py-2 text-gray-900">
                                    {{ $users->firstItem() + $loop->index }}
                                </td>

                                <td class="whitespace-nowrap px-4 py-2 text-gray-900">
                                    {{ $user->employee_number ?? '—' }}
                                </td>

                                <td class="whitespace-nowrap px-4 py-2 text-gray-900">
                                    {{ $user->name }}
                                </td>

                                <td class="whitespace-nowrap px-4 py-2 text-gray-900">
                                    {{ $user->email }}
                                </td>

                                <td class="whitespace-nowrap px-4 py-2 text-gray-900">
                                    {{ $user->getRoleNames()->first() ?? 'No role assigned' }}
                                </td>

                                <td class="whitespace-nowrap px-4 py-2 text-left">
                                    <div class="flex items-center justify-start gap-2">

                                        {{-- Edit User --}}
                                        @can('employees.edit')
                                            <a
                                                href="{{ route('settings.users.edit', $user->encrypted_id) }}"
                                                class="inline-flex items-center gap-1 text-blue-700 transition hover:text-blue-900"
                                                title="Edit user"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l2.651 2.651M4 20l4.5-1 11-11a2.121 2.121 0 00-3-3l-11 11L4 20z" />
                                                </svg>
                                                Edit
                                            </a>
                                        @endcan

                                        {{-- De-Activate User --}}
                                        @can('employees.deactivate')
                                            @if ($user->id !== auth()->id())
                                                <form
                                                    method="POST"
                                                    action="{{ route('settings.users.deactivate', $user->encrypted_id) }}"
                                                    onsubmit="event.preventDefault(); window.confirmDeactivate(event, this);"
                                                    class="inline-flex"
                                                >
                                                    @csrf
                                                    @method('PATCH')

                                                    <button
                                                        type="submit"
                                                        class="inline-flex items-center gap-1 whitespace-nowrap text-red-700 transition hover:text-red-900"
                                                        title="De-Activate User"
                                                    >
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4h6v3m-12 0h18" />
                                                        </svg>
                                                        De-Activate User
                                                    </button>
                                                </form>
                                            @endif
                                        @endcan

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="whitespace-nowrap px-4 py-6 text-center text-gray-500">
                                    No users have been registered yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <div class="border-t border-gray-300 pt-4">
                {{ $users->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
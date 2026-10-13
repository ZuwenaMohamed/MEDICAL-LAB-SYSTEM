<x-app-layout>
    @include('layouts.settings')

    <div class="mt-5 p-6">
        <div class="mx-auto max-w-5xl overflow-hidden rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">

            @include('layouts.user-roles')

            <div class="flex justify-end border-b border-gray-300 p-3">
                <a
                    href="{{ route('settings.users.index') }}"
                    class="inline-flex items-center gap-1 rounded-md bg-blue-700 px-3 py-2 text-sm font-semibold text-white transition hover:bg-blue-800"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to Users
                </a>
            </div>

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

                                        {{-- Activate User --}}
                                        @can('employees.activate')
                                            <form
                                                method="POST"
                                                action="{{ route('settings.users.activate', $user->encrypted_id) }}"
                                                onsubmit="event.preventDefault(); window.confirmActivate(event, this);"
                                                class="inline-flex"
                                            >
                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center gap-1 whitespace-nowrap text-green-700 transition hover:text-green-900"
                                                    title="Activate User"
                                                >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4 w-4"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                    >
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12l4 4L19 6" />
                                                        <circle cx="12" cy="12" r="9" />
                                                    </svg>
                                                    Activate User
                                                </button>
                                            </form>
                                        @endcan

                                        {{-- Remove User --}}
                                        @can('employees.delete')
                                            @if ($user->id !== auth()->id())
                                                <form
                                                    method="POST"
                                                    action="{{ route('settings.users.destroy', $user->encrypted_id) }}"
                                                    onsubmit="event.preventDefault(); window.confirmDelete(this, 'This will permanently remove the user. This action cannot be undone.');"
                                                    class="inline-flex"
                                                >
                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="inline-flex items-center gap-1 whitespace-nowrap text-red-700 transition hover:text-red-900"
                                                        title="Remove User"
                                                    >
                                                        Remove User
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
                                    No inactive users found.
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
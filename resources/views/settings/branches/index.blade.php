<x-app-layout>
    @include('layouts.settings')

    <div class="mt-5 p-6">

        <div class="overflow-hidden rounded-xl mx-auto max-w-5xl bg-white p-6 shadow-sm ring-1 ring-gray-200">

            {{-- Add New Branch --}}
            <div class="border-b border-gray-200 pb-3">
                <a
                    href="{{ route('settings.branches.create') }}"
                    class="inline-flex items-center gap-2 rounded-md bg-blue-700 px-4 py-2 text-sm font-medium text-white transition hover:bg-blue-800"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 5v14m-7-7h14"
                        />
                    </svg>

                    Add New Branch
                </a>
            </div>

            {{-- Branches Table --}}
            <div class="overflow-x-auto">

                <table class="min-w-full border-collapse">

                    <thead class="border-b-2 border-black bg-white">
                        <tr>
                           <th class="px-2 py-3 text-left text-sm font-bold text-gray-900">
                                No.
                            </th>
                            
                            <th class="px-2 py-3 text-left text-sm font-bold text-gray-900">
                                Name
                            </th>

                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-900">
                                Code
                            </th>

                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-900">
                                Company
                            </th>

                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-900">
                                Phone
                            </th>

                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-900">
                                Main Branch
                            </th>

                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-900">
                                Status
                            </th>

                            <th class="px-6 py-3 text-right text-sm font-bold text-gray-900">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody class="border-b border-gray-500">

                        @forelse ($branches as $branch)

                            <tr class="{{ $loop->odd ? 'bg-gray-200' : 'bg-white' }}">
                                <td class="px-2 py-0 text-sm text-gray-900">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-2 py-0 text-sm font-medium text-gray-900">
                                    {{ $branch->name }}
                                </td>

                                <td class="px-6 py-0 text-sm text-gray-900">
                                    {{ $branch->code }}
                                </td>

                                <td class="px-6 py-0 text-sm text-gray-900">
                                    {{ $branch->company->name }}
                                </td>

                                <td class="px-6 py-0 text-sm text-gray-900">
                                    {{ $branch->phone ?? '—' }}
                                </td>

                                <td class="px-6 py-0 text-sm">
                                    @if ($branch->is_main)
                                        <span class="font-medium text-blue-700">
                                            Yes
                                        </span>
                                    @else
                                        <span class="text-gray-600">
                                            No
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-0 text-sm">
                                    @if ($branch->status)
                                        <span class="font-medium text-green-700">
                                            Active
                                        </span>
                                    @else
                                        <span class="font-medium text-red-600">
                                            Inactive
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-0 text-right">
                                    <div class="flex items-center justify-end gap-0">

                                        {{-- View --}}
                                        <a
                                            href="{{ route('settings.branches.show', $branch) }}"
                                            class="inline-flex items-center justify-center rounded-md text-green-600 transition hover:bg-green-100 hover:text-green-900"
                                            title="View branch"
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
                                                    d="M2.036 12.322a1.012 1.012 0 010-.644C3.423 7.51 7.36 4.5 12 4.5c4.64 0 8.577 3.01 9.964 7.178a1.012 1.012 0 010 .644C20.577 16.49 16.64 19.5 12 19.5c-4.64 0-8.577-3.01-9.964-7.178z"
                                                />
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                                />
                                            </svg>
                                        </a>

                                        {{-- Edit --}}
                                        <a
                                            href="{{ route('settings.branches.edit', $branch) }}"
                                            class="inline-flex items-center justify-center rounded-md text-blue-700 transition hover:bg-blue-50 hover:text-blue-900"
                                            title="Edit branch"
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
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-9.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 7.5-7.5z"
                                                />
                                            </svg>
                                        </a>

                                        {{-- Delete --}}
                                        <form
                                            method="POST"
                                            action="{{ route('settings.branches.destroy', $branch) }}"
                                            onsubmit="event.preventDefault(); window.confirmDelete(this, 'This branch will be permanently deleted.');"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="inline-flex items-center justify-center rounded-md text-red-600 transition hover:bg-red-50 hover:text-red-800"
                                                title="Delete branch"
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
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h10"
                                                    />
                                                </svg>
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td
                                    colspan="7"
                                    class="px-6 py-8 text-center text-sm text-gray-500"
                                >
                                    No branches have been created yet.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- Pagination --}}
            <div class="pt-4">
                {{ $branches->links() }}
            </div>

        </div>

    </div>
</x-app-layout>
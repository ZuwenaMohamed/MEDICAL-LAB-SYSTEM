<x-app-layout>
    @include('layouts.settings')

    <div
        x-data="{ section: '{{ $errors->any() ? 'create' : 'list' }}' }"
        class="mt-10 space-y-1 p-6"
    >

        {{-- Companies List --}}
        <div
            x-show="section === 'list'"
            x-cloak
        >
            <div class="mb-5 flex items-center ps-43">
                <button
                    type="button"
                    @click="section = 'create'"
                    class="rounded-lg bg-blue-700 px-4 py-2 text-sm font-medium text-white hover:bg-blue-800"
                >
                    + Add New Company
                </button>
            </div>

            <div class="mx-auto max-w-4xl overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-200">

                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-white">
                        <tr class="first:border-b-2 first:border-black">
                            <th class="px-6 py-2 text-left text-sm font-semibold text-gray-900">
                                Name
                            </th>

                            <th class="px-6 py-2 text-left text-sm font-semibold text-gray-900">
                                Code
                            </th>

                            <th class="px-6 py-2 text-left text-sm font-semibold text-gray-900">
                                Phone
                            </th>

                            <th class="px-6 py-2 text-left text-sm font-semibold text-gray-900">
                                Status
                            </th>

                            <th class="px-6 py-2 text-right text-sm font-semibold text-gray-900">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @forelse ($companies as $company)

                            <tr class="even:bg-white odd:bg-gray-300">

                                <td class="px-6 py-0.5 text-sm">
                                    <a
                                        href="{{ route('settings.user-companies.show', $company) }}"
                                        class="font-medium text-blue-700 transition hover:text-blue-900 hover:underline"
                                    >
                                        {{ $company->name }}
                                    </a>
                                </td>

                                <td class="px-6 py-0.5 text-sm text-gray-600">
                                    {{ $company->code }}
                                </td>

                                <td class="px-6 py-0.5 text-sm text-gray-600">
                                    {{ $company->phone ?? '—' }}
                                </td>

                                <td class="px-6 py-0.5 text-sm">
                                    <span class="{{ $company->status ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $company->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>

                                <td class="px-6 py-0.5 text-right">
                                    <div class="flex items-center justify-end gap-0">

                                        {{-- View --}}
                                        <a
                                            href="{{ route('settings.user-companies.show', $company) }}"
                                            class="inline-flex items-center justify-center rounded-lg text-green-600 transition hover:bg-green-100 hover:text-green-900"
                                            title="View company"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.644C3.423 7.51 7.36 4.5 12 4.5c4.64 0 8.577 3.01 9.964 7.178a1.012 1.012 0 010 .644C20.577 16.49 16.64 19.5 12 19.5c-4.64 0-8.577-3.01-9.964-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </a>

                                        {{-- Edit --}}
                                        <a
                                            href="{{ route('settings.user-companies.edit', $company) }}"
                                            class="inline-flex items-center justify-center rounded-lg text-blue-700 transition hover:bg-blue-50 hover:text-blue-900"
                                            title="Edit company"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-9.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 7.5-7.5z" />
                                            </svg>
                                        </a>

                                        {{-- Delete --}}
                                        <form
                                            method="POST"
                                            action="{{ route('settings.user-companies.destroy', $company) }}"
                                            onsubmit="event.preventDefault(); window.confirmDelete(this, 'This company will be permanently deleted.');"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="inline-flex items-center justify-center rounded-lg text-red-600 transition hover:bg-red-50 hover:text-red-800"
                                                title="Delete company"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h10" />
                                                </svg>
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500">
                                    No companies have been registered yet.
                                </td>
                            </tr>

                        @endforelse
                    </tbody>

                </table>

                <div class="px-6 py-3">
                    {{ $companies->links() }}
                </div>

            </div>
        </div>

        {{-- Register Company Form --}}
        <div
            x-show="section === 'create'"
            x-cloak
        >
            <div class="mx-auto max-w-4xl">

                <form
                    method="POST"
                    action="{{ route('settings.user-companies.store') }}"
                    enctype="multipart/form-data"
                    class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200"
                >
                    @csrf

                    <div class="grid grid-cols-1 gap-x-5 gap-y-5 sm:grid-cols-2 lg:grid-cols-3">

                        <div>
                            <label for="name" class="mb-1.5 block text-sm font-medium text-gray-700">
                                Company Name <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="text"
                                name="name"
                                id="name"
                                value="{{ old('name') }}"
                                required
                                placeholder="Enter company name"
                                class="w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            />

                            @error('name')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="code" class="mb-1.5 block text-sm font-medium text-gray-700">
                                Company Code <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="text"
                                name="code"
                                id="code"
                                value="{{ old('code') }}"
                                required
                                placeholder="e.g. MED001"
                                class="w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            />

                            @error('code')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="mb-1.5 block text-sm font-medium text-gray-700">
                                Phone Number
                            </label>

                            <input
                                type="tel"
                                name="phone"
                                id="phone"
                                value="{{ old('phone') }}"
                                placeholder="Enter phone number"
                                class="w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            />

                            @error('phone')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="mb-1.5 block text-sm font-medium text-gray-700">
                                Email Address
                            </label>

                            <input
                                type="email"
                                name="email"
                                id="email"
                                value="{{ old('email') }}"
                                placeholder="company@example.com"
                                class="w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            />

                            @error('email')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="address" class="mb-1.5 block text-sm font-medium text-gray-700">
                                Company Address
                            </label>

                            <input
                                type="text"
                                name="address"
                                id="address"
                                value="{{ old('address') }}"
                                placeholder="Enter physical address"
                                class="w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            />

                            @error('address')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="logo" class="mb-1.5 block text-sm font-medium text-gray-700">
                                Company Logo
                            </label>

                            <input
                                type="file"
                                name="logo"
                                id="logo"
                                accept="image/*"
                                class="w-full rounded-lg border border-gray-300 text-sm text-gray-600 file:mr-3 file:border-0 file:bg-gray-100 file:px-3 file:py-2 hover:file:bg-gray-200"
                            />

                            @error('logo')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="brand_color" class="mb-1.5 block text-sm font-medium text-gray-700">
                                Brand Color
                            </label>

                            <div class="flex h-10 items-center gap-3 rounded-lg border border-gray-300 px-3">
                                <input
                                    type="color"
                                    name="brand_color"
                                    id="brand_color"
                                    value="{{ old('brand_color', '#1d4ed8') }}"
                                    class="h-7 w-9 cursor-pointer border-0 bg-transparent p-0"
                                />

                                <span class="text-sm text-gray-500">
                                    Choose company color
                                </span>
                            </div>

                            @error('brand_color')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="status" class="mb-1.5 block text-sm font-medium text-gray-700">
                                Company Status <span class="text-red-500">*</span>
                            </label>

                            <select
                                name="status"
                                id="status"
                                required
                                class="w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            >
                                <option value="1" @selected(old('status', '1') == '1')>
                                    Active
                                </option>

                                <option value="0" @selected(old('status') == '0')>
                                    Inactive
                                </option>
                            </select>

                            @error('status')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="mt-6 flex justify-end gap-3 border-t border-gray-200 pt-5">
                        <button
                            type="button"
                            @click="section = 'list'"
                            class="rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-100"
                        >
                            Cancel
                        </button>

                        <button
                            type="submit"
                            class="rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                        >
                            Register Company
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</x-app-layout>
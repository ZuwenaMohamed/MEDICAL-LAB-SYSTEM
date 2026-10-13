<x-app-layout>

    @include('layouts.settings')

    <div class="mt-10 space-y-6 p-6">

        <div class="mx-auto max-w-4xl">

            @if ($errors->any())
                <div class="mb-5 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                    <ul class="list-inside list-disc space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">

                <form
                    method="POST"
                    action="{{ route('settings.branches.store') }}"
                    class="space-y-5"
                >
                    @csrf

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">
                        <div>
                            <label for="company_id" class="mb-1 block text-sm font-medium text-gray-700">
                                Company <span class="text-red-600">*</span>
                            </label>

                            <select
                                id="company_id"
                                name="company_id"
                                required
                                class="w-full rounded-lg border-gray-300 text-sm focus:border-blue-500 focus:ring-blue-500"
                            >
                                <option value="">Select company</option>

                                @foreach ($companies as $company)
                                    <option
                                        value="{{ $company->id }}"
                                        @selected(old('company_id') == $company->id)
                                    >
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="name" class="mb-1 block text-sm font-medium text-gray-700">
                                Branch Name <span class="text-red-600">*</span>
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                maxlength="255"
                                placeholder="Enter branch name"
                                class="w-full rounded-lg border-gray-300 text-sm focus:border-blue-500 focus:ring-blue-500"
                            >
                        </div>

                        <div>
                            <label for="code" class="mb-1 block text-sm font-medium text-gray-700">
                                Branch Code <span class="text-red-600">*</span>
                            </label>

                            <input
                                type="text"
                                id="code"
                                name="code"
                                value="{{ old('code') }}"
                                required
                                maxlength="255"
                                placeholder="e.g. DAR-001"
                                class="w-full rounded-lg border-gray-300 text-sm focus:border-blue-500 focus:ring-blue-500"
                            >
                        </div>

                        <div>
                            <label for="phone" class="mb-1 block text-sm font-medium text-gray-700">
                                Phone
                            </label>

                            <input
                                type="text"
                                id="phone"
                                name="phone"
                                value="{{ old('phone') }}"
                                maxlength="255"
                                placeholder="Enter phone number"
                                class="w-full rounded-lg border-gray-300 text-sm focus:border-blue-500 focus:ring-blue-500"
                            >
                        </div>

                        <div>
                            <label for="email" class="mb-1 block text-sm font-medium text-gray-700">
                                Email
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                maxlength="255"
                                placeholder="Enter email address"
                                class="w-full rounded-lg border-gray-300 text-sm focus:border-blue-500 focus:ring-blue-500"
                            >
                        </div>
                         <div>
                        <label for="address" class="mb-1 block text-sm font-medium text-gray-700">
                            Address
                        </label>

                        <input
                            id="address"
                            value="{{ old('address') }}"
                            name="address"
                            maxlength="255"
                            placeholder="Enter branch address"
                            class="w-full rounded-lg border-gray-300 text-sm focus:border-blue-500 focus:ring-blue-500"
                        >
                    </div>

                        <div>
                            <label for="is_main" class="mb-1 block text-sm font-medium text-gray-700">
                                Main Branch
                            </label>

                            <select
                                id="is_main"
                                name="is_main"
                                class="w-full rounded-lg border-gray-300 text-sm focus:border-blue-500 focus:ring-blue-500"
                            >
                                <option value="0" @selected(old('is_main', '0') == '0')>
                                    No
                                </option>

                                <option value="1" @selected(old('is_main') == '1')>
                                    Yes
                                </option>
                            </select>
                        </div>

                        <div>
                            <label for="status" class="mb-1 block text-sm font-medium text-gray-700">
                                Status
                            </label>

                            <select
                                id="status"
                                name="status"
                                class="w-full rounded-lg border-gray-300 text-sm focus:border-blue-500 focus:ring-blue-500"
                            >
                                <option value="1" @selected(old('status', '1') == '1')>
                                    Active
                                </option>

                                <option value="0" @selected(old('status') == '0')>
                                    Inactive
                                </option>
                            </select>
                        </div>

                    </div>


                    </div>

                    <div class="flex items-center justify-end gap-3 border-t border-gray-200 pt-5">

                        <a
                            href="{{ route('settings.branches.index') }}"
                            class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="rounded-lg bg-blue-700 px-5 py-2 text-sm font-medium text-white hover:bg-blue-800"
                        >
                            Save Branch
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>
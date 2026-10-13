<x-app-layout>
    @include('layouts.settings')

    <div class="mx-auto mt-10 max-w-4xl space-y-6 px-6 pb-8">

        @if ($errors->any())
            <div class=" w-full rounded-md  border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                <p class="font-semibold">Please correct the following errors:</p>

                <ul class="mt-2 list-inside list-disc space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="rounded-lg border border-gray-200 bg-white shadow-sm">

            <form
                method="POST"
                action="{{ route('settings.users.store') }}"
                class="space-y-6 p-6"
            >
                @csrf
                <input
                    type="hidden"
                    name="branch_id"
                    value="{{ $selectedBranchId }}"
                >

                <div class="grid grid-cols-1 gap-5 md:grid-cols-3">

                    <div>
                        <label for="name" class=" mb-1.5 block text-sm font-medium text-gray-700">
                            Full Name <span class="text-red-600">*</span>
                        </label>

                        <input
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name') }}"
                            required
                            autofocus
                            autocomplete="name"
                            class=" w-full rounded-md  border-gray-300 text-sm shadow-sm focus:border-blue-700 focus:ring-blue-700"
                            placeholder="Enter full name"
                        >
                    </div>

                    <div>
                        <label for="email" class="mb-1.5 block text-sm font-medium text-gray-700">
                            Email Address <span class="text-red-600">*</span>
                        </label>

                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            class=" w-full rounded-md  border-gray-300 text-sm shadow-sm focus:border-blue-700 focus:ring-blue-700"
                            placeholder="employee@example.com"
                        >
                    </div>

                    <div>
                        <label for="phone" class="mb-1.5 block text-sm font-medium text-gray-700">
                            Phone Number
                        </label>

                        <input
                            id="phone"
                            name="phone"
                            type="tel"
                            value="{{ old('phone') }}"
                            autocomplete="tel"
                            class=" w-full rounded-md  border-gray-300 text-sm shadow-sm focus:border-blue-700 focus:ring-blue-700"
                            placeholder="Enter phone number"
                        >
                    </div>

                    <div>
                        <label for="role" class="mb-1.5 block text-sm font-medium text-gray-700">
                            Assign Role <span class="text-red-600">*</span>
                        </label>

                        <select
                            id="role"
                            name="role"
                            required
                            class=" w-full rounded-md  border-gray-300 text-sm shadow-sm focus:border-blue-700 focus:ring-blue-700"
                        >
                            <option value="">Select a role</option>

                            @foreach ($roles as $role)
                                <option
                                    value="{{ $role->name }}"
                                    @selected(old('role') === $role->name)
                                >
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="password" class="mb-1.5 block text-sm font-medium text-gray-700">
                            Password <span class="text-red-600">*</span>
                        </label>

                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            autocomplete="new-password"
                            class=" w-full rounded-md  border-gray-300 text-sm shadow-sm focus:border-blue-700 focus:ring-blue-700"
                            placeholder="At least 8 characters"
                        >
                    </div>

                    <div>
                        <label for="password_confirmation" class="mb-1.5 block text-sm font-medium text-gray-700">
                            Confirm Password <span class="text-red-600">*</span>
                        </label>

                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            required
                            autocomplete="new-password"
                            class=" w-full rounded-md  border-gray-300 text-sm shadow-sm focus:border-blue-700 focus:ring-blue-700"
                            placeholder="Repeat password"
                        >
                    </div>

                </div>

                <div class="flex justify-end gap-3 border-t border-gray-200 pt-5">

                    <a
                        href="{{ route('settings.users.index') }}"
                        class="rounded-md  border border-gray-300 px-5 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="rounded-md bg-blue-700 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                    >
                        Register Employee
                    </button>

            </form>

        </div>

    </div>
</x-app-layout>
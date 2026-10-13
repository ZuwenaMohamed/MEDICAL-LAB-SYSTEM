 <x-guest-layout>
    <div class="mx-auto w-full max-w-md rounded-xl border border-gray-200 bg-white p-6 shadow-sm sm:p-8">

        {{-- Header --}}
        <div class="mb-7 text-center">
            <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-700 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 14.5a7 7 0 0 1-14 0c0-2.5 2-4.5 4-6.5V4h6v4c2 2 4 4 4 6.5Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 4h6M8 15h8m-6-3h4" />
                </svg>
            </div>

            <h1 class="text-2xl font-bold tracking-tight text-gray-900">
                Create Account
            </h1>

            <p class="mt-2 text-sm text-gray-500">
                Medical Laboratory System
            </p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            {{-- Name --}}
            <div>
                <x-input-label for="name" :value="__('Full Name')" class="mb-1.5 font-medium text-gray-700" />

                <x-text-input
                    id="name"
                    class="block w-full rounded-lg border-gray-300 px-4 py-2.5 text-sm shadow-sm focus:border-blue-600 focus:ring-blue-600"
                    type="text"
                    name="name"
                    :value="old('name')"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Enter your full name"
                />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            {{-- Email --}}
            <div>
                <x-input-label for="email" :value="__('Email Address')" class="mb-1.5 font-medium text-gray-700" />

                <x-text-input
                    id="email"
                    class="block w-full rounded-lg border-gray-300 px-4 py-2.5 text-sm shadow-sm focus:border-blue-600 focus:ring-blue-600"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autocomplete="username"
                    placeholder="you@example.com"
                />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            {{-- Password --}}
            <div>
                <x-input-label for="password" :value="__('Password')" class="mb-1.5 font-medium text-gray-700" />

                <x-text-input
                    id="password"
                    class="block w-full rounded-lg border-gray-300 px-4 py-2.5 text-sm shadow-sm focus:border-blue-600 focus:ring-blue-600"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="Enter your password"
                />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            {{-- Confirm Password --}}
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="mb-1.5 font-medium text-gray-700" />

                <x-text-input
                    id="password_confirmation"
                    class="block w-full rounded-lg border-gray-300 px-4 py-2.5 text-sm shadow-sm focus:border-blue-600 focus:ring-blue-600"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Confirm your password"
                />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            {{-- Register --}}
            <button
                type="submit"
                class="flex w-full items-center justify-center rounded-lg bg-blue-700 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2"
            >
                {{ __('Register') }}
            </button>

            {{-- Login Link --}}
            <p class="text-center text-sm text-gray-600">
                Already registered?

                <a
                    href="{{ route('login') }}"
                    class="font-semibold text-blue-700 transition hover:text-blue-900 hover:underline"
                >
                    Log in
                </a>
            </p>
        </form>
    </div>
</x-guest-layout>
<x-guest-layout>
    <!-- Session Status -->

    <x-auth-session-status class="mb-4" :status="session('status')" />



    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mật khẩu')" />

            <x-text-input id="password" class="block mt-1 w-full"
                type="password"
                name="password"
                required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4 d-flex justify-content-end">
            <label for="remember_me" class="inline-flex items-center d-none">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Ghi nhớ tài khoản') }}</span>
            </label>
            @if (Route::has('password.request'))
            <a class="text-decoration-underline text-muted fs-6 hover-text-dark rounded-3 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary" href="{{ route('password.request') }}">
                {{ __('Quên mật khẩu?') }}
            </a>
            @endif
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a class="text-decoration-underline text-muted fs-6 hover-text-dark rounded-3 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary" href="{{ route('register') }}">
                {{ __('Chưa có tài khoản?') }}
            </a>
            <button class="btn btn-primary ms-3">
                {{__('Đăng nhập')}}
            </button>
        </div>

    </form>
</x-guest-layout>
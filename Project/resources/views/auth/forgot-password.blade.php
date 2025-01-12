<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Quên mật khẩu? Không sao cả. Chỉ cần cho chúng tôi biết địa chỉ email của bạn và chúng tôi sẽ gửi liên kết đặt lại mật khẩu qua email để bạn có thể tạo một mật khẩu mới.') }}
    </div>

    <!-- Trạng thái phiên -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Địa chỉ Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Gửi Liên Kết Đặt Lại Mật Khẩu') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

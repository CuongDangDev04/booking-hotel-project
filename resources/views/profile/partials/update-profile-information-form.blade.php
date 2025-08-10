<section>
    <header>
        <h2 class="h5 text-dark">
            {{ __('Thông tin cá nhân') }}
        </h2>

        <p class="mt-2 text-muted">
            {{ __("Cập nhật thông tin tài khoản và địa chỉ email") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Tên') }}</label>
            <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            @if($errors->get('name'))
            <div class="invalid-feedback d-block">
                {{ $errors->get('name')[0] }}
            </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username" />
            @if($errors->get('email'))
            <div class="invalid-feedback d-block">
                {{ $errors->get('email')[0] }}
            </div>
            @endif

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-2">
                <p class="text-muted">
                    {{ __('Địa chỉ email của bạn chưa được xác minh.') }}

                    <button form="send-verification" class="btn btn-link p-0 text-decoration-none">
                        {{ __('Bấm vào đây để gửi lại email xác minh.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                <p class="mt-2 font-medium text-success">
                    {{ __('Một liên kết xác minh mới đã được gửi đến địa chỉ email của bạn.') }}
                </p>
                @endif
            </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">{{ __('Lưu') }}</button>

            @if (session('status') === 'profile-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-muted">{{ __('Đã lưu.') }}</p>
            @endif
        </div>
    </form>
</section>
<section>
    <header>
        <h2 class="h5 text-dark">
            {{ __('Cập nhật mật khẩu') }}
        </h2>

        <p class="mt-2 text-muted">
            {{ __('Đảm bảo tài khoản của bạn đang sử dụng mật khẩu dài, ngẫu nhiên để giữ an toàn.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="update_password_current_password" class="form-label">{{ __('Mật khẩu hiện tại') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" />
            @if($errors->updatePassword->has('current_password'))
            <div class="invalid-feedback d-block">
                {{ $errors->updatePassword->get('current_password')[0] }}
            </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="update_password_password" class="form-label">{{ __('Mật khẩu mới') }}</label>
            <input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password" />
            @if($errors->updatePassword->has('password'))
            <div class="invalid-feedback d-block">
                {{ $errors->updatePassword->get('password')[0] }}
            </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="update_password_password_confirmation" class="form-label">{{ __('Xác nhận mật khẩu') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" />
            @if($errors->updatePassword->has('password_confirmation'))
            <div class="invalid-feedback d-block">
                {{ $errors->updatePassword->get('password_confirmation')[0] }}
            </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">{{ __('Lưu') }}</button>

            @if (session('status') === 'password-updated')
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
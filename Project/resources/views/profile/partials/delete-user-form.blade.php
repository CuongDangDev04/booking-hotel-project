<section class="mb-5">
    <header>
        <h2 class="h5 text-dark">
            {{ __('Xóa tài khoản') }}
        </h2>

        <p class="mt-2 text-muted">
            {{ __('Sau khi tài khoản của bạn bị xóa, tất cả tài nguyên và dữ liệu của tài khoản đó sẽ bị xóa vĩnh viễn. Trước khi xóa tài khoản của bạn, vui lòng tải xuống mọi dữ liệu hoặc thông tin mà bạn muốn giữ lại.') }}
        </p>
    </header>

    <button
        class="btn btn-danger"
        data-bs-toggle="modal"
        data-bs-target="#confirmUserDeletionModal">
        {{ __('Xóa tài khoản') }}
    </button>

    <!-- Modal -->
    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="{{ route('profile.destroy') }}" class="modal-content p-4">
                @csrf
                @method('delete')

                <div class="modal-header">
                    <h5 class="modal-title" id="confirmUserDeletionModalLabel">
                        {{ __('Có chắc chắn muốn xóa tài khoản?') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p class="text-muted">
                        {{ __('Sau khi tài khoản của bạn bị xóa, tất cả tài nguyên và dữ liệu của tài khoản đó sẽ bị xóa vĩnh viễn. Vui lòng nhập mật khẩu của bạn để xác nhận rằng bạn muốn xóa vĩnh viễn tài khoản của mình.') }}
                    </p>

                    <div class="mb-3">
                        <label for="password" class="form-label sr-only">{{ __('Mật khẩu') }}</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control"
                            placeholder="{{ __('Mật khẩu') }}">
                        @if($errors->userDeletion->has('password'))
                        <div class="invalid-feedback d-block">
                            {{ $errors->userDeletion->get('password')[0] }}
                        </div>
                        @endif
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        {{ __('Hủy') }}
                    </button>
                    <button type="submit" class="btn btn-danger">
                        {{ __('Xóa tài khoản') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
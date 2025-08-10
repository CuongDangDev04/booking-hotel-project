<nav class="navbar2" style="background-color: #0F172B">
    <a href="/" class="logo">
        <div class="row">
            <div class="logo d-flex justify-content-center ">
                <p style="color:#FEA116 !important" class="text-primary  fs-1 fw-bold">HOTELIER</p>
            </div>
        </div>
    </a>
    @auth

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn-logout" type="submit">{{ __('Đăng xuất') }}</button>
    </form>


    @endif
</nav>
<nav class="navbar2" style="background-color: #0F172B">
    <a href="/admin" class="logo">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="navbar2-br height="50px" />

    </a>
    @auth

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn-logout" type="submit">{{ __('Đăng xuất') }}</button>
    </form>


    @endif
</nav>

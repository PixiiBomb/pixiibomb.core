<nav class="navbar navbar-expand-lg app-navbar">
    <div class="container">

        <a class="navbar-brand app-brand" href="/">
            <span>pixiib💣mb</span>
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#pixiiNavbar"
            aria-controls="pixiiNavbar"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="pixiiNavbar">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">

                <li class="nav-item">
                    <a class="nav-link active" href="/">Home</a>
                </li>

                @isset($user)
                    <li class="nav-item dropdown user-menu">
                        <button
                            class="user-menu-trigger"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            <img
                                src="{{ asset($user->getAvatarPath()) }}"
                                alt="{{ $user->username }} avatar"
                                class="user-avatar"
                            >

                            <span class="user-name">{{ $user->username }}</span>
                        </button>

                        <div class="dropdown-menu dropdown-menu-end user-dropdown">
                            <div class="user-dropdown-header">
                                <img
                                    src="{{ asset($user->getAvatarPath()) }}"
                                    alt="{{ $user->username }} avatar"
                                    class="user-dropdown-avatar"
                                >

                                <div>
                                    <strong>{{ $user->username }}</strong>
                                    <span>{{ $user->email }}</span>
                                </div>
                            </div>

                            <div class="user-dropdown-divider"></div>

                            <a class="dropdown-item" href="{{ route('dashboard') }}">
                                Dashboard
                            </a>

                            <a class="dropdown-item" href="{{ route('themes') }}">
                                Appearance
                            </a>

                            <div class="user-dropdown-divider"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit" class="dropdown-item logout-item">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>

                    <li class="nav-item">
                        <a class="btn btn-primary btn-sm" href="{{ route('register') }}">
                            Register
                        </a>
                    </li>
                @endisset

            </ul>
        </div>

    </div>
</nav>

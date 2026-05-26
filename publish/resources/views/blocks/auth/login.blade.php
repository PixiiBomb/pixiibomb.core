<section class="auth-page auth-login container-fluid">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-11 col-sm-10 col-md-8 col-lg-5 col-xl-4">

            <div class="auth-card">

                <div class="auth-header text-center">
                    <img
                        src="{{ asset('images/logo_pixibomb_simple.png') }}"
                        alt="PixiiBomb"
                        class="auth-logo"
                    >

                    <h1 class="auth-title">
                        Welcome Back
                    </h1>

                    <p class="auth-subtitle">
                        Login to continue to {{ config('app.name') }}.
                    </p>
                </div>

                <form
                    method="POST"
                    action="{{ route('login.submit') }}"
                    class="auth-form"
                >
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">
                            Email
                        </label>

                        <input
                            id="email"
                            name="email"
                            type="email"
                            class="form-control"
                            placeholder="you@example.com"
                            required
                            autofocus
                        >
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">
                            Password
                        </label>

                        <input
                            id="password"
                            name="password"
                            type="password"
                            class="form-control"
                            placeholder="••••••••"
                            required
                        >
                    </div>

                    <button
                        type="submit"
                        class="btn btn-primary auth-submit w-100"
                    >
                        Login
                    </button>
                </form>

                <div class="auth-footer text-center">
                    <span>
                        Don't have an account?
                    </span>

                    <a href="{{ url('/register') }}">
                        Create one
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>

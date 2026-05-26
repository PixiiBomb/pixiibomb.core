@php
    $user = auth()->user();
    $avatar = $user?->getAvatarPath() ?? 'images/avatars/default.png';
@endphp

<style>

    .profile-card {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        align-items: center;
        gap: var(--padding-lg);
    }

    .dashboard-avatar-wrap {
        position: relative;
        display: inline-flex;
        width: var(--icon-xl);
        height: var(--icon-xl);
        border-radius: 50%;
        overflow: hidden;
        cursor: pointer;
    }

    .dashboard-avatar {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

    .dashboard-avatar-overlay {
        position: absolute;
        inset: 0;
        display: grid;
        place-items: center;
        font-size: var(--font-xl);
        color: var(--color-text-on-primary);
        background: rgb(0 0 0 / 45%);
        opacity: 0;
        transition: opacity 160ms ease-in-out;
    }

    .dashboard-avatar-wrap:hover .dashboard-avatar-overlay {
        opacity: 1;
    }

    .dashboard-profile-info {
        flex: 1;
    }
</style>
<section class="dashboard-page container py-5">
    <div class="card">
        <div class="card-body profile-card">
            <form id="avatar-form" action="{{ route('dashboard.avatar') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <label class="dashboard-avatar-wrap" for="avatar">
                    <img src="{{ asset($avatar) }}" alt="{{ $user?->username ?? 'User' }} avatar" class="dashboard-avatar">
                    <span class="dashboard-avatar-overlay">🖼️</span>
                </label>

                <input id="avatar" name="avatar" type="file" accept="image/*" class="d-none" onchange="document.getElementById('avatar-form').submit();">
            </form>

            <div class="dashboard-profile-info">
                <p class="dashboard-kicker">
                    {{ $user?->role?->display_name ?? 'User' }}
                </p>

                <h1 class="dashboard-title">
                    {{ $user?->username ?? 'Creator' }}
                </h1>

                <p class="dashboard-subtitle">
                    {{ $user?->email }}
                </p>
            </div>

            <div class="dashboard-badge">
                Logged In
            </div>
        </div>
    </div>

</section>

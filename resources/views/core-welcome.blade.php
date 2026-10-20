<style>
    html,
    body {
        margin: 0;
        width: 100%;
        height: 100%;
    }

    .container {
        width: 100%;
        height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: #faf7f2;
        color: #241f24;
        font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    .card {
        text-align: center;
        padding: 2.5rem 3rem;
    }

    .title {
        margin: 0;
        font-size: clamp(2rem, 5vw, 4rem);
        font-weight: 800;
        letter-spacing: -0.04em;
    }

    .version-info {
        margin-top: 0.75rem;
        font-size: 0.95rem;
        opacity: 0.65;
    }
</style>

<div class="container">
    <div class="card">
        <h1 class="title">🧚‍♀️ PixiiBomb Installed 💣</h1>

        <div class="version-info">
            @foreach($packages as $package)
                <div>
                    📦 <strong>{{ $package['name'] }}</strong> · <span>{{ $package['version'] }}</span>
                </div>
            @endforeach
        </div>
    </div>
</div>

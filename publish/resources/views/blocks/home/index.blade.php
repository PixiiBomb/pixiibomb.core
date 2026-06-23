@php
    $version = config('settings.version');
@endphp

<style>
    .feature-gradient-bg {
        position: relative;
        padding: 0;
        min-height: 100vh;
        background: radial-gradient(
            ellipse at 22% 70%,
            color-mix(in srgb, var(--color-primary) 45%, transparent),
            transparent 55%
        ),
        radial-gradient(
            ellipse at 58% 45%,
            color-mix(in srgb, var(--color-secondary) 35%, transparent),
            transparent 50%
        ),
        radial-gradient(
            ellipse at 88% 55%,
            color-mix(in srgb, var(--color-accent) 30%, transparent),
            transparent 60%
        ),
        linear-gradient(
            120deg,
            var(--color-bg-primary) 0%,
            var(--color-bg-secondary) 45%,
            var(--color-bg-primary) 100%
        );
        overflow: hidden;
    }

    .particle {
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
        opacity: 0.5;
        background: radial-gradient(
            circle,
            color-mix(in srgb, var(--color-primary) 90%, white) 0%,
            var(--color-primary) 45%,
            transparent 75%
        );
        box-shadow: 0 0 18px color-mix(in srgb, var(--color-primary) 80%, transparent),
        0 0 42px color-mix(in srgb, var(--color-primary) 45%, transparent),
        0 0 80px color-mix(in srgb, var(--color-primary) 25%, transparent);

        filter: blur(0.25px);
    }

    .particle.alternate {
        background: radial-gradient(
            circle,
            color-mix(in srgb, var(--color-bg-primary) 90%, white) 0%,
            var(--color-primary) 45%,
            transparent 75%
        );
    }

    #particle-background,
    #particle-foreground,
    #halo-foreground {
        position: absolute;
        inset: 0;
        pointer-events: none;
    }

    #particle-background {
        z-index: 0;
    }

    #particle-foreground {
        z-index: 2;
    }

    .feature-content {
        position: relative;
        z-index: 1;
    }

    .pixii-orb-card {
        position: relative;
        display: inline-grid;
        place-items: center;
        margin-bottom: var(--padding-xl);
    }

    .pixii-icon-tile {
        position: relative;
        display: grid;
        place-items: center;

        width: clamp(var(--icon-lg), 12vw, var(--icon-xl));
        height: clamp(var(--icon-lg), 12vw, var(--icon-xl));

        border-radius: var(--radius-lg);
        border: var(--border-sm) solid color-mix(in srgb, var(--color-border-primary) 55%, transparent);

        background: linear-gradient(
            145deg,
            color-mix(in srgb, var(--color-bg-secondary) 80%, white 6%),
            color-mix(in srgb, var(--color-bg-primary) 92%, black 8%)
        );

        box-shadow: inset 0 1px 0 color-mix(in srgb, white 22%, transparent),
        inset 0 -18px 40px color-mix(in srgb, var(--color-bg-primary) 55%, transparent),
        0 0 0 8px color-mix(in srgb, var(--color-primary) 6%, transparent),
        0 18px 45px color-mix(in srgb, black 38%, transparent),
        0 0 55px color-mix(in srgb, var(--color-primary) 28%, transparent),
        0 0 100px color-mix(in srgb, var(--color-secondary) 18%, transparent);

        overflow: hidden;
        backdrop-filter: blur(var(--blur-md));
        animation: tile-float 7s ease-in-out infinite;
    }

    .pixii-icon-tile::before {
        content: "";
        position: absolute;
        inset: -40%;
        background: conic-gradient(
            from 0deg,
            transparent,
            color-mix(in srgb, var(--color-primary) 35%, transparent),
            transparent,
            color-mix(in srgb, var(--color-accent) 25%, transparent),
            transparent
        );
        opacity: 0.55;
        animation: halo-spin 12s linear infinite;
    }

    .pixii-icon-tile::after {
        content: "";
        position: absolute;
        inset: -20%;
        background: linear-gradient(
            115deg,
            transparent 35%,
            color-mix(in srgb, white 34%, transparent) 48%,
            color-mix(in srgb, var(--color-secondary) 42%, transparent) 50%,
            transparent 65%
        );
        transform: translateX(-130%) rotate(8deg);
        animation: lens-sweep 5.5s ease-in-out infinite;
    }

    .pixii-icon {
        position: relative;
        z-index: 1;
        font-size: clamp(2.6rem, 6vw, 4.75rem);
        filter: drop-shadow(0 0 12px color-mix(in srgb, var(--color-primary) 55%, transparent)) drop-shadow(0 0 26px color-mix(in srgb, var(--color-secondary) 38%, transparent));
        animation: icon-pulse 3.5s ease-in-out infinite;
    }

    @keyframes tile-float {
        0%, 100% {
            transform: translateY(0) rotate(0deg);
        }

        50% {
            transform: translateY(-8px) rotate(0.75deg);
        }
    }

    @keyframes halo-spin {
        to {
            transform: rotate(360deg);
        }
    }

    @keyframes lens-sweep {
        0%, 30% {
            transform: translateX(-130%) rotate(8deg);
            opacity: 0;
        }

        45% {
            opacity: 1;
        }

        70%, 100% {
            transform: translateX(130%) rotate(8deg);
            opacity: 0;
        }
    }

    @keyframes icon-pulse {
        0%, 100% {
            transform: scale(1);
            opacity: 0.95;
        }

        50% {
            transform: scale(1.06);
            opacity: 1;
        }
    }
</style>

<div class="container-fluid feature-gradient-bg min-vh-100 d-flex">
    <div id="particle-background"></div>

    <div class="container flex-grow-1 d-flex feature-content">
        <div class="row flex-grow-1 w-100">
            <div class="col-12 text-center d-flex flex-column justify-content-center">
                <div class="pixii-orb-card">
                    <div class="pixii-icon-tile">
                        <span class="pixii-icon">🧚‍♀️</span>
                    </div>
                </div>
                <h1>🧚‍♀️PixiiBomb.Core💣</h1>
                @if($version)
                    <p class="lead">installed : {{ $version }}</p>
                @else
                    <p class="lead">installed</p>
                @endif
            </div>
        </div>
    </div>

    <div id="particle-foreground"></div>
</div>

<script>
    const maxParticles = 8;
    const minSize = 6;
    const maxSize = 20;
    const minSpeed = 0.03;
    const maxSpeed = 0.12;

    const background = document.getElementById('particle-background');
    const foreground = document.getElementById('particle-foreground');

    const particles = [];

    createParticles(getRandomInt(2, maxParticles), background, 0.18);
    createParticles(getRandomInt(2, maxParticles), foreground, 0.45);

    requestAnimationFrame(animateParticles);

    function getRandomInt(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    function getRandomFloat(min, max) {
        return Math.random() * (max - min) + min;
    }

    function getRandomDirection() {
        return Math.random() < 0.5 ? -1 : 1;
    }

    function createParticles(count, container, baseOpacity) {
        const bounds = container.getBoundingClientRect();

        for (let i = 0; i < count; i++) {
            const color = getRandomInt(0, 1);
            const size = getRandomInt(minSize, maxSize);
            const x = getRandomFloat(0, bounds.width - size);
            const y = getRandomFloat(0, bounds.height - size);

            const particle = document.createElement('div');
            particle.classList.add('particle');

            if (color === 1) {
                particle.classList.add('alternate');
            }

            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            particle.style.opacity = getRandomFloat(baseOpacity, baseOpacity + 0.35);

            container.appendChild(particle);

            particles.push({
                element: particle,
                container,
                x,
                y,
                size,
                vx: getRandomFloat(minSpeed, maxSpeed) * getRandomDirection(),
                vy: getRandomFloat(minSpeed, maxSpeed) * getRandomDirection()
            });
        }
    }

    function animateParticles() {
        particles.forEach((particle) => {
            const bounds = particle.container.getBoundingClientRect();

            particle.x += particle.vx;
            particle.y += particle.vy;

            if (particle.x <= 0 || particle.x + particle.size >= bounds.width) {
                particle.vx *= -1;
                particle.x = Math.max(0, Math.min(particle.x, bounds.width - particle.size));
            }

            if (particle.y <= 0 || particle.y + particle.size >= bounds.height) {
                particle.vy *= -1;
                particle.y = Math.max(0, Math.min(particle.y, bounds.height - particle.size));
            }

            particle.element.style.transform = `translate3d(${particle.x}px, ${particle.y}px, 0)`;
        });

        requestAnimationFrame(animateParticles);
    }
</script>

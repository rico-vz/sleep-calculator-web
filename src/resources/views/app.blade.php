<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ ($appearance ?? 'dark') === 'dark' ? 'dark no-fouc' : 'no-fouc' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="{{ config('app.name', 'SleepApp') }}" />
    <link rel="manifest" href="/site.webmanifest" />

    <script>
        (() => {
            try {
                const savedAppearance = localStorage.getItem('appearance');
                const isDark = savedAppearance === 'dark'
                    || (savedAppearance !== 'light' && window.matchMedia('(prefers-color-scheme: dark)').matches);
                document.documentElement.classList.toggle('dark', isDark);
            } catch (e) {
                // no-op: keep server-rendered class fallback
            }
        })();
    </script>

    <style>
        html {
            background-color: hsl(0 0% 100%);
            color: hsl(240 10% 3.9%);
        }

        html.dark {
            background-color: hsl(222 47% 11%);
            color: hsl(0 0% 95%);
        }

        body {
            margin: 0;
            background-color: inherit;
            color: inherit;
            font-family: Inter, ui-sans-serif, system-ui, sans-serif;
        }

        html.no-fouc #app {
            visibility: hidden;
        }

        html.fouc-ready #app {
            visibility: visible;
        }
    </style>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600" rel="stylesheet" />

    @routes
    @vite(['resources/js/app.ts'])
    @inertiaHead
    <script defer src="https://io.zenso.digital/core" data-website-id="e9384704-9330-469a-b657-8a34ce113dba"></script>
    <script defer src="https://io.zenso.digital/recorder.js" data-website-id="e9384704-9330-469a-b657-8a34ce113dba" data-sample-rate="0.15" data-mask-level="moderate" data-max-duration="300000"></script>
</head>

<body class="bg-background text-foreground font-sans antialiased">
    @inertia
</body>

</html>

<?php

use App\Http\Middleware\EnsurePasswordIsSet;
use App\Http\Middleware\HandleAppearance;
use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Events\DiagnosingHealth;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        then: function () {
            Route::get('/up', function () {
                $exception = null;

                try {
                    Event::dispatch(new DiagnosingHealth);
                } catch (Throwable $e) {
                    if (app()->hasDebugModeEnabled()) {
                        throw $e;
                    }

                    report($e);

                    $exception = $e->getMessage();
                }

                $commitHash = null;
                $commitDate = null;

                foreach ([base_path(), dirname(base_path()), dirname(base_path(), 2)] as $path) {
                    $hashProcess = Process::path($path)->run('git rev-parse --short HEAD');

                    if (! $hashProcess->successful()) {
                        continue;
                    }

                    $dateProcess = Process::path($path)->run('git show -s --format=%cI HEAD');

                    if (! $dateProcess->successful()) {
                        continue;
                    }

                    $commitHash = trim($hashProcess->output());
                    $commitDate = trim($dateProcess->output());

                    break;
                }

                $commitHash ??= 'unknown';

                if ($commitDate) {
                    try {
                        $commitDate = Carbon::parse($commitDate)->toDayDateTimeString();
                    } catch (Throwable) {
                    }
                }

                $commitDate ??= 'unknown';

                return response(View::make('health-up', [
                    'commitDate' => $commitDate,
                    'commitHash' => $commitHash,
                    'exception' => $exception,
                ]), status: $exception ? 500 : 200);
            });
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->encryptCookies(except: ['appearance', 'sidebar_state']);

        $middleware->web(append: [
            HandleAppearance::class,
            HandleInertiaRequests::class,
            AddLinkHeadersForPreloadedAssets::class,
            EnsurePasswordIsSet::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

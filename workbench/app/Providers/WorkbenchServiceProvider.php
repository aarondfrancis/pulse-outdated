<?php

namespace Workbench\App\Providers;

use AaronFrancis\Pulse\Outdated\Recorders\OutdatedRecorder;
use Illuminate\Support\ServiceProvider;

class WorkbenchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        config(['pulse.recorders' => [
            OutdatedRecorder::class => []
        ]]);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use SimpleSoftwareIO\QrCode\Generator;
use SimpleSoftwareIO\QrCode\Driver\GdDriver;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // QR Code pakai GD
        $this->app->singleton(Generator::class, function () {
            return new Generator(new GdDriver());
        });

        $this->app->alias(Generator::class, 'qrCode');
    }

    public function boot(): void
    {
        // Gates
        Gate::define('manage-visits', fn($u) => in_array($u->role, ['Admin','Perawat','Dokter']));
        Gate::define('manage-prescriptions', fn($u) => in_array($u->role, ['Admin','Dokter','Farmasi']));
        Gate::define('manage-payments', fn($u) => in_array($u->role, ['Admin','Kasir']));

        // Log query biasa
        if (env('APP_DEBUG')) {
            DB::listen(function ($query) {
                Log::channel('query')->debug('Query Executed', [
                    'sql'        => $query->sql,
                    'bindings'   => $query->bindings,
                    'time'       => $query->time . 'ms',
                    'connection' => $query->connectionName,
                ]);
            });
        }

        // LOG SLOW QUERY (FORMAT BENAR UNTUK LARAVEL 11)
        // //DB::whenQueryingForLongerThan(500, function ($event) {
        //     Log::channel('query')->warning('Slow Query Detected', [
        //         'connection' => $event->connection->getName(),
        //         'sql'        => $event->sql,
        //         'bindings'   => $event->bindings,
        //         'time'       => $event->time . 'ms',
        //     ]);
        // });
    }
}

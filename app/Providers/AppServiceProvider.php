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
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Paksa simple-qrcode pakai GD, bukan Imagick
        $this->app->singleton(Generator::class, function () {
            return new Generator(new GdDriver());
        });
        // Optional: alias 'qrCode' agar facade tetap jalan
        $this->app->alias(Generator::class, 'qrCode');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('manage-visits', fn($u) => in_array($u->role, ['Admin','Perawat','Dokter']));
        Gate::define('manage-prescriptions', fn($u) => in_array($u->role, ['Admin','Dokter','Farmasi']));
        Gate::define('manage-payments', fn($u) => in_array($u->role, ['Admin','Kasir']));

        // Log semua query SQL
        if (env('APP_DEBUG') === true) {
            DB::listen(function ($query) {
                Log::channel('query')->debug('Query Executed', [
                    'sql' => $query->sql,
                    'bindings' => $query->bindings,
                    'time' => $query->time . 'ms',
                    'connection' => $query->connectionName,
                ]);
            });
        }

        // Log slow queries
        DB::whenQueryingForLongerThan(500, function ($connection, $query, $time) {
            Log::channel('query')->warning('Slow Query Detected', [
                'connection' => $connection->getName(),
                'query' => $query,
                'time' => $time . 'ms',
            ]);
        });
    }
}
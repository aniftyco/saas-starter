<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use TailwindMerge\Contracts\TailwindMergeContract;
use TailwindMerge\TailwindMerge;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register Tailwind Merge
        $this->app->singleton(TailwindMergeContract::class, function () {
            return TailwindMerge::instance();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        URL::forceScheme('https');
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(app()->isProduction());
        Model::automaticallyEagerLoadRelationships();

        Vite::useBuildDirectory(null);
        Vite::useManifestFilename('assets/manifest.json');
        Vite::useAggressivePrefetching();
    }
}

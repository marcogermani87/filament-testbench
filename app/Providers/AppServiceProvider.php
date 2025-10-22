<?php

namespace App\Providers;

use App\Filament\Pages\RemoteApiPage;
use App\Filament\Resources\Blogs\Pages\ListBlogs;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Filament\Support\Facades\FilamentView;
use Filament\Tables\View\TablesRenderHook;
use Spatie\CpuLoadHealthCheck\CpuLoadCheck;
use Spatie\Health\Checks\Checks\CacheCheck;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;
use Spatie\Health\Checks\Checks\OptimizedAppCheck;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;
use Spatie\Health\Facades\Health;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $isProduction = app()->isProduction();

        Model::unguard();

        Model::preventLazyLoading(!$isProduction);

        FilamentView::registerRenderHook(
            TablesRenderHook::TOOLBAR_START,
            fn(): string => Blade::render(
                '<x-filament::loading-indicator wire:loading wire:target="previousPage,gotoPage,nextPage" class="h-5 w-5" />'
            ),
            scopes: [
                ListBlogs::class,
                RemoteApiPage::class,
            ]
        );

        Health::checks([
            CpuLoadCheck::new()
                ->failWhenLoadIsHigherInTheLast5Minutes(2.0)
                ->failWhenLoadIsHigherInTheLast15Minutes(1.5),
            UsedDiskSpaceCheck::new()
                ->warnWhenUsedSpaceIsAbovePercentage(60)
                ->failWhenUsedSpaceIsAbovePercentage(80),
            DatabaseCheck::new(),
            CacheCheck::new()
                ->if(fn() => $isProduction),
            OptimizedAppCheck::new()
                ->if(fn() => $isProduction),
            DebugModeCheck::new()
                ->if(fn() => $isProduction),
            EnvironmentCheck::new()
                ->if(fn() => $isProduction),
        ]);
    }
}

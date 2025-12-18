<?php

namespace App\Providers\Filament;

use App\Filament\Umkm\Pages\Dashboard;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class UmkmPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('umkm')
            ->path('umkm')
            ->login()
            ->colors([
                'primary' => Color::Blue,
            ])
            ->brandName('SIPETA UMKM')
            ->favicon(asset('favicon.ico'))
            ->discoverResources(in: app_path('Filament/Umkm/Resources'), for: 'App\\Filament\\Umkm\\Resources')
            ->discoverPages(in: app_path('Filament/Umkm/Pages'), for: 'App\\Filament\\Umkm\\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Umkm/Widgets'), for: 'App\\Filament\\Umkm\\Widgets')
            ->widgets([
                AccountWidget::class,
            ])
            ->sidebarCollapsibleOnDesktop()
            ->navigationGroups([
                'Inventaris',
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}

<?php

namespace App\Providers\Filament;

use App\Filament\Resources\ArticleResource;
use App\Filament\Resources\BannerResource;
use App\Filament\Resources\BlogResource;
use App\Filament\Resources\CategoryResource;
use App\Filament\Resources\ClientResource;
use App\Filament\Resources\ContactResource;
use App\Filament\Resources\DutyScheduleResource;
use App\Filament\Resources\ManagerResource;
use App\Filament\Resources\MaterialResource;
use App\Filament\Resources\OldProductResource;
use App\Filament\Resources\PageResource;
use App\Filament\Resources\PopupResource;
use App\Filament\Resources\PortfolioResource;
use App\Filament\Resources\RequestResource;
use App\Filament\Resources\ReviewResource;
use App\Filament\Resources\SocialNetworkResource;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->brandName('WOODSTREAM')
            ->login()
            ->sidebarWidth('200px')
            ->maxContentWidth('full')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->resources([
                ArticleResource::class,
                BlogResource::class,
                CategoryResource::class,
                ClientResource::class,
                ContactResource::class,
                DutyScheduleResource::class,
                ManagerResource::class,
                MaterialResource::class,
                OldProductResource::class,
                PageResource::class,
                PopupResource::class,
                PortfolioResource::class,
                RequestResource::class,
                ReviewResource::class,
                SocialNetworkResource::class,
            ])
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
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
            ])
            ->databaseNotifications(false)
            ->databaseNotificationsPolling(false)
            ->spa();
    }
}

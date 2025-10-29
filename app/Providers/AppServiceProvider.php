<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\SocialNetwork;
use App\Models\Contact;
use App\Models\DutySchedule;
use App\Models\Category;
use App\Observers\SocialNetworkObserver;
use App\Observers\ContactObserver;
use App\Observers\DutyScheduleObserver;
use App\Observers\CategoryObserver;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        SocialNetwork::observe(SocialNetworkObserver::class);
        Contact::observe(ContactObserver::class);
        DutySchedule::observe(DutyScheduleObserver::class);
        Category::observe(CategoryObserver::class);

    }
}

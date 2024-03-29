<?php

namespace App\Providers;

use App\Events\Order\OrderWasCreated;
use App\Listeners\Order\SendEmailCreatedListener;
use App\Listeners\SendEmailNewUserListener;
use App\Observers\BrandObserver;
use App\Observers\CategoryObserver;
use Domain\Cart\CartManager;
use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Domain\User\Events\AfterSessionRegenerated;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            SendEmailNewUserListener::class,
        ],
        OrderWasCreated::class => [
            SendEmailCreatedListener::class,
        ],
    ];

    public function boot(): void
    {
        Category::observe(CategoryObserver::class);
        Brand::observe(BrandObserver::class);

        Event::listen(AfterSessionRegenerated::class, function (AfterSessionRegenerated $event) {
            app(CartManager::class)->updateStorageId($event->old, $event->current);
        });
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}

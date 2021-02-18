<?php

namespace Modules\Ums\Providers;

use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    /**
     * Boot the observers.
     */
    public function boot()
    {
        \Modules\Ums\Entities\User::observe(\Modules\Ums\Observers\UserObserver::class);
        \Modules\Ums\Entities\UserPersonalInfo::observe(\Modules\Ums\Observers\UserPersonalInfoObserver::class);
        \Modules\Ums\Entities\UserResidentialInfo::observe(\Modules\Ums\Observers\UserResidentialInfoObserver::class);
        \Modules\Ums\Entities\UserEducationalInfo::observe(\Modules\Ums\Observers\UserEducationalInfoObserver::class);
        \Modules\Ums\Entities\UserWorkInfo::observe(\Modules\Ums\Observers\UserWorkInfoObserver::class);
        \Modules\Ums\Entities\SocialSite::observe(\Modules\Ums\Observers\SocialSiteObserver::class);
        \Modules\Ums\Entities\UserSocialAccount::observe(\Modules\Ums\Observers\UserSocialAccountObserver::class);
        \Modules\Ums\Entities\UserContent::observe(\Modules\Ums\Observers\UserContentObserver::class);
        \Modules\Ums\Entities\UserLanguage::observe(\Modules\Ums\Observers\UserLanguageObserver::class);
        \Modules\Ums\Entities\UserInterest::observe(\Modules\Ums\Observers\UserInterestObserver::class);
        \Modules\Ums\Entities\Module::observe(\Modules\Ums\Observers\ModuleObserver::class);
        \Modules\Ums\Entities\Role::observe(\Modules\Ums\Observers\RoleObserver::class);
        \Modules\Ums\Entities\Permission::observe(\Modules\Ums\Observers\PermissionObserver::class);
        //[OBSERVER_REGISTER]
    }
}

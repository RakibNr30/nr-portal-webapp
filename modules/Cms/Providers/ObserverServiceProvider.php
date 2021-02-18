<?php

namespace Modules\Cms\Providers;

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
        \Modules\Cms\Entities\Slider::observe(\Modules\Cms\Observers\SliderObserver::class);
        \Modules\Cms\Entities\Menu::observe(\Modules\Cms\Observers\MenuObserver::class);
        \Modules\Cms\Entities\MenuLink::observe(\Modules\Cms\Observers\MenuLinkObserver::class);
        \Modules\Cms\Entities\PageCategory::observe(\Modules\Cms\Observers\PageCategoryObserver::class);
        \Modules\Cms\Entities\Page::observe(\Modules\Cms\Observers\PageObserver::class);
        \Modules\Cms\Entities\ContentCategory::observe(\Modules\Cms\Observers\ContentCategoryObserver::class);
        \Modules\Cms\Entities\Content::observe(\Modules\Cms\Observers\ContentObserver::class);
        \Modules\Cms\Entities\ContentCategory::observe(\Modules\Cms\Observers\ContentCategoryObserver::class);
        \Modules\Cms\Entities\Content::observe(\Modules\Cms\Observers\ContentObserver::class);
        \Modules\Cms\Entities\ArticleCategory::observe(\Modules\Cms\Observers\ArticleCategoryObserver::class);
        \Modules\Cms\Entities\Article::observe(\Modules\Cms\Observers\ArticleObserver::class);
        \Modules\Cms\Entities\ArticleView::observe(\Modules\Cms\Observers\ArticleViewObserver::class);
        \Modules\Cms\Entities\Faq::observe(\Modules\Cms\Observers\FaqObserver::class);
        \Modules\Cms\Entities\Quote::observe(\Modules\Cms\Observers\QuoteObserver::class);
        \Modules\Cms\Entities\Testimonial::observe(\Modules\Cms\Observers\TestimonialObserver::class);
        \Modules\Cms\Entities\ImportantPerson::observe(\Modules\Cms\Observers\ImportantPersonObserver::class);
        //[OBSERVER_REGISTER]
    }
}

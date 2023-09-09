<?php

namespace App\Providers;

use App\Admission;
use App\BreakingNews;
use App\ImportantLink;
use App\Menu;
use App\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Resources\Json\JsonResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        Blade::include('layouts.input', 'input');
        Schema::defaultStringLength(191);
        JsonResource::withoutWrapping();
        if (!$this->app->runningInConsole()) {
            access_school();
            if (config('app.env') === 'production') {
              //  \URL::forceScheme('https');
            }
            if (now()->gt(foqas_setting('add_result_pubtime'))) {
                (new Admission())->cal_merit_with_mark();
            }
            (new Admission())->waiting_1();
            (new Admission())->waiting_2();
            (new Admission())->waiting_3();
            view()->composer('*', function () {
                $language = session('localLang');
                if (empty($language)) {
                    $language = foqas_setting('language') ?? 'en';
                }
                App::setLocale($language);
            });
            view()->composer('public.inc.footer', function ($view) {
                $notices = Notice::bySchool(\school('id'))->whereActive(1)->latest()->take(3)->get();
                $view->with('noticesFooter', $notices);
            });
            view()->composer('public.inc.header', function ($view) {
                $menus = (new Menu())->getMenusAll(true);
                $view->with('menus', $menus);
            });
            view()->composer('public.inc.pages-header', function ($view) {
                $menus = (new Menu())->getMenusAll(true);
                $view->with('menus', $menus);
            });
            view()->composer('public.inc.breaking_news', function ($view) {
                $breaking_newses = BreakingNews::bySchool(school('id'))->where('status', '1')->orderBy('priority')->get();
                $view->with('breaking_newses', $breaking_newses);
            });
            view()->composer('public.inc.index_about_1', function ($view) {
                $message_menus = Menu::bySchool(\school('id'))->whereIn('menus.slug', ['chairman-message', 'headteacher-message'])->where('status', 1)->get();
                $view->with('message_menus', $message_menus);
            });
            view()->composer('public.inc.counter', function ($view) {
                $importantLinks = ImportantLink::bySchool(\school('id'))->status()->orderBy('parioty')->get();
                $view->with('importantLinks', $importantLinks);
            });
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local', 'testing')) {
            $this->app->register(\Laravel\Dusk\DuskServiceProvider::class);
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
            $this->app->register(\Rap2hpoutre\LaravelLogViewer\LaravelLogViewerServiceProvider::class);
        }
    }
}

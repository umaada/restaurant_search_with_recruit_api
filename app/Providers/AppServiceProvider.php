<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;

use App\Budget;
use App\LargeServiceArea;
use App\ServiceArea;
use App\LargeArea;
use App\MiddleArea;
use App\SmallArea;
use App\Genre;
use App\CreditCard;
use App\Special;
use App\SpecialCategory;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         View::share('budgets', Budget::all());
         // View::share('largeServiceAreas', LargeServiceArea::all());
         // View::share('serviceAreas', ServiceArea::all());
         View::share('largeAreas', LargeArea::all());
         // View::share('middleAreas', MiddleArea::all());
         // View::share('smallAreas', SmallArea::all());
         View::share('genres', Genre::all());
         View::share('creditCards', CreditCard::all());
         // View::share('specials', Special::all());
         // View::share('specialCategories', SpecialCategory::all());
    }
}

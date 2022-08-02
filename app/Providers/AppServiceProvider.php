<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Spatie\LaravelIgnition\Facades\Flare;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        date_default_timezone_set('America/Toronto');

        Flare::determineVersionUsing(function () {
            return '1.0'; // return your version number
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setHolidaysRegion('ca-on');
        Carbon::setHolidayName('truth-and-reconciliation', 'en', 'The National Day for Truth and Reconciliation');
        Carbon::setHolidayName('christmas-next-day', 'en', 'Boxing Day');
        Carbon::setHolidayName('11-11', 'en', 'Remembrance Day');

        Model::unguard(true);

        Builder::macro('whereLike', function (string $attribute, string $searchTerm) {
            return $this->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
        });

        Builder::macro('search', function (string $field, string $string) {
            return $string ? $this->where($field, 'LIKE', "%{$string}%") : $this;
        });
        Builder::macro('orSearch', function (string $field, string $string) {
            return $string ? $this->orWhere($field, 'LIKE', "%{$string}%") : $this;
        });
    }
}

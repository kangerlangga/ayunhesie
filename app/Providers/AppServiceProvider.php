<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

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
        $cutOffVisitorOver15 = Carbon::now()->subDays(15);
        DB::table('shetabit_visits')->where('created_at', '<', $cutOffVisitorOver15)->delete();
    }
}

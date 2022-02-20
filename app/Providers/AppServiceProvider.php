<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\User;
use App\Observers\UserObserver;
use App\Models\Telegram;
use App\Observers\TelegramObserver;
use App\Models\History;
use App\Observers\HistoryObserver;
use App\Services\IpService;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\App;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        User::observe(UserObserver::class);
        Telegram::observe(TelegramObserver::class);
        History::observe(HistoryObserver::class);
        if (!isset($_COOKIE['visitor_country'])) {
            $ipService = new IpService;
            $ipPublic = $ipService->getIpPublic();
            $data = Location::get($ipPublic);
            if ($data) {
                $minute = 60;
                $hour = 3600;
                $day = 86400;
                $week = 604800;
                setcookie('visitor_country', $data->countryCode, time() + ($minute * 1));
                $_COOKIE['visitor_country'] = $data->countryCode;
            }
        }
        $countryCode = false;
        if (isset($_COOKIE['visitor_country'])) {
            $countryCode = $_COOKIE['visitor_country'];
        }
        App::setLocale('en');
        if ($countryCode == 'ID') {
            App::setLocale('id');
        }
    }
}

<?php

namespace App\Providers;

use App\Services\CampaignManagerService;
use App\Services\CampaignManagerServiceInterface;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(CampaignManagerServiceInterface::class, CampaignManagerService::class);
    }
}

<?php

namespace App\Repositories\Providers;

use Illuminate\Support\ServiceProvider;

class CampaignRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Contracts\CampaignRepositoryInterface',
            'App\Repositories\Eloquent\CampaignRepository'
        );
    }
}

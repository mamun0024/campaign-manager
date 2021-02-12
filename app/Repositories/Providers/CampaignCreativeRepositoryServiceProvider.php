<?php

namespace App\Repositories\Providers;

use Illuminate\Support\ServiceProvider;

class CampaignCreativeRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Contracts\CampaignCreativeRepositoryInterface',
            'App\Repositories\Eloquent\CampaignCreativeRepository'
        );
    }
}

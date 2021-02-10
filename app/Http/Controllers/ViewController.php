<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ViewController extends Controller
{
    /**
     * Campaign list view.
     *
     * @return Application|Factory|View
     *
     * @author "Md. Abdullah-Al- Mamun" <mamuncse824@gmail.com>
     */
    public function campaignList()
    {
        return view('list');
    }

    /**
     * Create Campaign view.
     *
     * @return Application|Factory|View
     *
     * @author "Md. Abdullah-Al- Mamun" <mamuncse824@gmail.com>
     */
    public function createCampaign()
    {
        return view('create');
    }

    /**
     * Update Campaign view.
     *
     * @param int $campaign_id Campaign ID
     * @return Application|Factory|View
     *
     * @author "Md. Abdullah-Al- Mamun" <mamuncse824@gmail.com>
     */
    public function updateCampaign(int $campaign_id)
    {
        return view('update', compact('campaign_id'));
    }
}

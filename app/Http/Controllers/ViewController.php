<?php

namespace App\Http\Controllers;

class ViewController extends Controller
{
    public function campaignList()
    {
        return view('list');
    }

    public function createCampaign()
    {
        return view('create');
    }

    public function updateCampaign($campaign_id)
    {
        return view('update', compact('campaign_id'));
    }
}

<?php

namespace App\Repositories\Contracts;

use App\Models\Campaign;
use App\Models\CampaignCreative;
use Illuminate\Database\Eloquent\Model;

interface CampaignCreativeRepositoryInterface
{
    /**
     * Get Campaign Creative Details.
     *
     * @param int $campaign_id Campaign ID.
     * @return CampaignCreative|null Campaign Creative details from database.
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function campaignCreativeDetails(int $campaign_id): ?CampaignCreative;

    /**
     * Create campaign creatives.
     *
     * @param Campaign $campaign Campaign Model.
     * @param array $campaign_creative_data All campaign data.
     * @return CampaignCreative|null Campaign creatives model data.
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function createCampaignCreative(Campaign $campaign, array $campaign_creative_data): ?CampaignCreative;

    /**
     * Delete campaign creatives.
     *
     * @param int $campaign_creative_id Campaign creative id.
     * @return bool
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function deleteCampaignCreative(int $campaign_creative_id): bool;
}

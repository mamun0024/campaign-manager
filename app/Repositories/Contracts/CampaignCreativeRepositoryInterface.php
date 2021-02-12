<?php

namespace App\Repositories\Contracts;

use App\Models\Campaign;

interface CampaignCreativeRepositoryInterface
{
    /**
     * Create campaign creatives.
     *
     * @param Campaign $campaign Campaign Model.
     * @param array $campaign_creative_data All campaign data.
     * @return Campaign|null Campaign model data.
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function createCampaignCreative(Campaign $campaign, array $campaign_creative_data): ?Campaign;

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

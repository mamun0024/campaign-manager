<?php

namespace App\Repositories\Eloquent;

use App\Models\Campaign;
use App\Models\CampaignCreative;
use App\Repositories\Contracts\CampaignCreativeRepositoryInterface;

class CampaignCreativeRepository implements CampaignCreativeRepositoryInterface
{
    private $campaign_creative;

    public function __construct(CampaignCreative $campaign_creative)
    {
        $this->campaign_creative = $campaign_creative;
    }

    /**
     * Create campaign creatives.
     *
     * @param Campaign $campaign Campaign Model.
     * @param array $campaign_creative_data All campaign data.
     * @return Campaign|null Campaign model data.
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function createCampaignCreative(Campaign $campaign, array $campaign_creative_data): ?Campaign
    {
        foreach ($campaign_creative_data as $creative) {
            $campaign->creatives()->create($creative);
        }
        return $campaign;
    }

    /**
     * Delete campaign creatives.
     *
     * @param int $campaign_creative_id Campaign creative id.
     * @return bool
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function deleteCampaignCreative(int $campaign_creative_id): bool
    {
        return $this->campaign_creative->where(CampaignCreative::CREATIVE_ID, $campaign_creative_id)->delete();
    }
}

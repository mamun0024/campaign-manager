<?php

namespace App\Repositories\Eloquent;

use App\Models\Campaign;
use App\Repositories\Contracts\CampaignRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CampaignRepository implements CampaignRepositoryInterface
{
    private $campaign;

    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    /**
     * Get Campaign Lists.
     *
     * @return HasMany Campaign list from database.
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function campaignLists(): HasMany
    {
        return $this->campaign->creatives()->orderBy(Campaign::CAMPAIGN_ID, 'desc');
    }

    /**
     * Get Campaign Details.
     *
     * @param int $campaign_id Campaign ID.
     * @return Campaign|Builder|Model|object|null Campaign details from database.
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function campaignDetails(int $campaign_id): ?Campaign
    {
        return $this->campaign->creatives()->where(Campaign::CAMPAIGN_ID, $campaign_id)->first();
    }

    /**
     * Create campaign.
     *
     * @param array $campaign_data All campaign data.
     * @return Campaign|null Campaign model data.
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function createCampaign(array $campaign_data): ?Campaign
    {
        return $this->campaign->create($campaign_data);
    }

    /**
     * Update campaign.
     *
     * @param array $campaign_data All campaign data.
     * @param int $campaign_id Campaign ID.
     * @return Campaign|null Campaign model data.
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function updateCampaign(array $campaign_data, int $campaign_id): ?Campaign
    {
        $campaign_model = $this->campaign->where(Campaign::CAMPAIGN_ID, $campaign_id)->first();
        foreach ($campaign_data as $index => $value) {
            $campaign_model->{$index} = $value;
        }
        $campaign_model->save();
        return $campaign_model;
    }
}

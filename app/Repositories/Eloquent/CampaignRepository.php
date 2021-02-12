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
     * @return array|empty Campaign list from database.
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function campaignLists(): array
    {
        return $this->campaign->with('creatives')->orderBy(Campaign::CAMPAIGN_ID, 'desc')->get()->toArray();
    }

    /**
     * Get Campaign Details.
     *
     * @param int $campaign_id Campaign ID.
     * @return array|empty Campaign details from database.
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function campaignDetails(int $campaign_id): array
    {
        $campaign_details = $this->campaign->with('creatives')->where(Campaign::CAMPAIGN_ID, $campaign_id)->first();
        if ($campaign_details) {
            $campaign_details = $campaign_details->toArray();
        } else {
            $campaign_details = [];
        }
        return $campaign_details;
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

<?php

namespace App\Repositories\Contracts;

use App\Models\Campaign;
use Illuminate\Database\Eloquent\Model;

interface CampaignRepositoryInterface
{
    /**
     * Get Campaign Lists.
     *
     * @return Campaign|null Campaign list from database.
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function campaignLists(): ?Campaign;

    /**
     * Get Campaign Details.
     *
     * @param int $campaign_id Campaign ID.
     * @return Campaign|null Campaign details from database.
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function campaignDetails(int $campaign_id): ?Campaign;

    /**
     * Create campaign.
     *
     * @param array $campaign_data All campaign data.
     * @return Campaign|null Campaign model data.
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function createCampaign(array $campaign_data): ?Campaign;

    /**
     * Update campaign.
     *
     * @param array $campaign_data All campaign data.
     * @param int $campaign_id Campaign ID.
     * @return Campaign|null Campaign model data.
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function updateCampaign(array $campaign_data, int $campaign_id): ?Campaign;
}

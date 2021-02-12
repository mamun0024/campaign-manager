<?php

namespace App\Services;

use App\Models\Campaign;

interface CampaignManagerServiceInterface
{
    /**
     * Get Campaign Lists.
     *
     * @return  array|empty Campaign list from database.
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function campaignLists(): array;

    /**
     * Get Campaign Details.
     *
     * @param int $campaign_id Campaign ID.
     * @return array|empty Campaign details from database.
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function campaignDetails(int $campaign_id): array;

    /**
     * Create campaign.
     *
     * @param array $request Http request.
     * @return Campaign|null Campaign model data.
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function createCampaign(array $request): ?Campaign;

    /**
     * Update campaign.
     *
     * @param int $campaign_id Campaign ID.
     * @param array $request Http request.
     * @return Campaign|null Campaign model data.
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function updateCampaign(int $campaign_id, array $request): ?Campaign;

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

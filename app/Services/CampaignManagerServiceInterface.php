<?php

namespace App\Services;

use Exception;

interface CampaignManagerServiceInterface
{
    /**
     * Get Campaign Lists.
     *
     * @param array $request Http request.
     * @return array Application response.
     * @throws Exception
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function campaignLists(array $request): array;

    /**
     * Get Campaign Details.
     *
     * @param int $campaign_id Campaign ID.
     * @return array Application response.
     * @throws Exception
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function campaignDetails(int $campaign_id): array;

    /**
     * Create campaign.
     *
     * @param array $request Http request.
     * @return array Application response.
     * @throws Exception
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function createCampaign(array $request): array;

    /**
     * Update campaign.
     *
     * @param int $campaign_id Campaign ID.
     * @param array $request Http request.
     * @return array Application response.
     * @throws Exception
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function updateCampaign(int $campaign_id, array $request): array;

    /**
     * Delete campaign creatives.
     *
     * @param int $campaign_creative_id Campaign creative id.
     * @return array Application response.
     * @throws Exception
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function deleteCampaignCreative(int $campaign_creative_id): array;
}

<?php

namespace App\Services;

use App\Repositories\Contracts\CampaignRepositoryInterface;
use App\Repositories\Contracts\CampaignCreativeRepositoryInterface;
use App\Utils\Traits\HelperTrait;
use App\Models\Campaign;
use App\Models\CampaignCreative;
use Illuminate\Support\Facades\Storage;

class CampaignManagerService implements CampaignManagerServiceInterface
{
    use HelperTrait;

    private $campaign_repository;
    private $campaign_creative_repository;

    public function __construct(
        CampaignRepositoryInterface $campaign_repository,
        CampaignCreativeRepositoryInterface $campaign_creative_repository
    ) {
        $this->campaign_repository = $campaign_repository;
        $this->campaign_creative_repository = $campaign_creative_repository;
    }

    /**
     * Get Campaign Lists.
     *
     * @return  array|empty Campaign list from database.
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function campaignLists(): array
    {
        return $this->campaign_repository->campaignLists();
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
        return $this->campaign_repository->campaignDetails($campaign_id);
    }

    /**
     * Create campaign.
     *
     * @param array $request Http request.
     * @return Campaign|null Campaign model data.
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function createCampaign(array $request): ?Campaign
    {
        $prepare_data       = $this->prepareCampaignCreateUpdateData($request);
        $campaign_data      = $prepare_data["campaign"];
        $campaign_creatives = $prepare_data["creatives"];

        $campaign = $this->campaign_repository->createCampaign($campaign_data);
        return $this->campaign_creative_repository->createCampaignCreative($campaign, $campaign_creatives);
    }

    /**
     * Update campaign.
     *
     * @param int $campaign_id Campaign ID.
     * @param array $request Http request.
     * @return Campaign|null Campaign model data.
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function updateCampaign(int $campaign_id, array $request): ?Campaign
    {
        $prepare_data       = $this->prepareCampaignCreateUpdateData($request);
        $campaign_data      = $prepare_data["campaign"];
        $campaign_creatives = $prepare_data["creatives"];

        $campaign = $this->campaign_repository->updateCampaign($campaign_data, $campaign_id);
        return $this->campaign_creative_repository->createCampaignCreative($campaign, $campaign_creatives);
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
        return $this->campaign_creative_repository->deleteCampaignCreative($campaign_creative_id);
    }

    /**
     * Prepare campaign & campaign creative
     * create/update data.
     *
     * @param array $request Campaign creative id.
     * @return array campaign & campaign creative data.
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function prepareCampaignCreateUpdateData(array $request): array
    {
        $campaign_data = [];
        $campaign_data[Campaign::CAMPAIGN_NAME]         = $request['name'];
        $campaign_data[Campaign::CAMPAIGN_FROM_DATE]    = $request['from_date'];
        $campaign_data[Campaign::CAMPAIGN_TO_DATE]      = $request['to_date'];
        $campaign_data[Campaign::CAMPAIGN_TOTAL_BUDGET] = $request['total_budget'];
        $campaign_data[Campaign::CAMPAIGN_DAILY_BUDGET] = $request['daily_budget'];

        if (isset($request['creatives'])) {
            $campaign_creatives = $this->uploadCampaignCreatives($request['creatives']);
        } else {
            $campaign_creatives = [];
        }
        return [
            "campaign" => $campaign_data,
            "creatives" => $campaign_creatives
        ];
    }

    /**
     * Upload images in storage and returns
     * array with file name and file path
     *
     * @param array $campaign_creatives Campaign Creatives.
     * @return array Application response.
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    private function uploadCampaignCreatives(array $campaign_creatives): array
    {
        $uploadedCreatives = [];
        foreach ($campaign_creatives as $key => $creative) {
            $name = uniqid() . '_' . $creative->getClientOriginalName();
            Storage::disk('public')->put($name, file_get_contents($creative));
            $uploadedCreatives[$key] = [
                CampaignCreative::CREATIVE_FILE_NAME => $name,
                CampaignCreative::CREATIVE_FILE_PATH => Storage::url($name)
            ];
        }
        return $uploadedCreatives;
    }
}

<?php

namespace App\Services;

use App\Repositories\Contracts\CampaignRepositoryInterface;
use App\Repositories\Contracts\CampaignCreativeRepositoryInterface;
use App\Utils\Traits\HelperTrait;
use App\Models\Campaign;
use App\Models\CampaignCreative;
use Exception;
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
     * @param array $request Http request.
     * @return array Application response.
     * @throws Exception
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function campaignLists(array $request): array
    {
        try {
            $campaign_list = $this->campaign_repository->campaignLists();
            $response = $this->responseData(
                true,
                200,
                "Campaign lists fetched successfully.",
                $campaign_list
            );
        } catch (Exception $e) {
            $response = $this->responseData(
                false,
                500,
                "Campaign lists not fetched successfully.",
                null,
                $e->getMessage()
            );
        }
        return $response;
    }

    /**
     * Get Campaign Details.
     *
     * @param int $campaign_id Campaign ID.
     * @return array Application response.
     * @throws Exception
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function campaignDetails(int $campaign_id): array
    {
        try {
            $campaign_data = $this->campaign_repository->campaignDetails($campaign_id);
            $response = $this->responseData(
                true,
                200,
                "Campaign details fetched successfully.",
                $campaign_data
            );
        } catch (Exception $e) {
            $response = $this->responseData(
                false,
                500,
                "Campaign details not fetched successfully.",
                null,
                $e->getMessage()
            );
        }
        return $response;
    }

    /**
     * Create campaign.
     *
     * @param array $request Http request.
     * @return array Application response.
     * @throws Exception
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function createCampaign(array $request): array
    {
        try {
            $prepare_data       = $this->prepareCampaignCreateUpdateData($request);
            $campaign_data      = $prepare_data["campaign"];
            $campaign_creatives = $prepare_data["creatives"];

            $campaign = $this->campaign_repository->createCampaign($campaign_data);
            $campaign = $this->campaign_creative_repository->createCampaignCreative($campaign, $campaign_creatives);

            $response = $this->responseData(
                true,
                200,
                "Campaign created successfully.",
                $campaign
            );
        } catch (Exception $e) {
            $response = $this->responseData(
                false,
                500,
                "Campaign not created successfully.",
                null,
                $e->getMessage()
            );
        }
        return $response;
    }

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
    public function updateCampaign(int $campaign_id, array $request): array
    {
        try {
            $prepare_data       = $this->prepareCampaignCreateUpdateData($request);
            $campaign_data      = $prepare_data["campaign"];
            $campaign_creatives = $prepare_data["creatives"];

            $campaign = $this->campaign_repository->updateCampaign($campaign_data, $campaign_id);
            $campaign = $this->campaign_creative_repository->createCampaignCreative($campaign, $campaign_creatives);

            $response = $this->responseData(
                true,
                200,
                "Campaign updated successfully.",
                $campaign
            );
        } catch (Exception $e) {
            $response = $this->responseData(
                false,
                500,
                "Campaign not updated successfully.",
                null,
                $e->getMessage()
            );
        }
        return $response;
    }

    /**
     * Delete campaign creatives.
     *
     * @param int $campaign_creative_id Campaign creative id.
     * @return array Application response.
     * @throws Exception
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function deleteCampaignCreative(int $campaign_creative_id): array
    {
        try {
            $campaign_creative = $this->campaign_creative_repository->deleteCampaignCreative($campaign_creative_id);
            if ($campaign_creative) {
                $response = $this->responseData(
                    true,
                    200,
                    "Campaign creative deleted successfully.",
                    null,
                    "Campaign creative deleted successfully."
                );
            } else {
                throw new Exception("Campaign creative not deleted.");
            }
        } catch (Exception $e) {
            $response = $this->responseData(
                false,
                500,
                "Campaign creative not deleted.",
                null,
                $e->getMessage()
            );
        }
        return $response;
    }

    /**
     * Prepare campaign & campaign creative
     * create/update data.
     *
     * @param array $request Campaign creative id.
     * @return array campaign & campaign creative data.
     * @throws Exception
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
     * @throws Exception
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

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCampaign;
use App\Http\Requests\UpdateCampaign;
use App\Services\CampaignManagerServiceInterface;
use App\Utils\Traits\HelperTrait;
use Exception;
use Illuminate\Http\JsonResponse;

class CampaignController extends Controller
{
    use HelperTrait;

    private $campaign_manager_service;

    public function __construct(CampaignManagerServiceInterface $campaign_manager_service)
    {
        $this->campaign_manager_service = $campaign_manager_service;
    }

    /**
     * Get Campaign Lists.
     *
     * @return JsonResponse Application response.
     * @throws Exception
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function campaignLists(): JsonResponse
    {
        try {
            $campaign_list = $this->campaign_manager_service->campaignLists();
            if ($this->emptyCheck($campaign_list)) {
                $response_code = 200;
                $response_data = $this->responseData(
                    true,
                    $response_code,
                    "Campaign lists fetched successfully.",
                    $campaign_list
                );
            } else {
                $response_code = 404;
                $response_data = $this->responseData(
                    false,
                    $response_code,
                    "Not found.",
                    "",
                    "No campaign data found."
                );
            }
        } catch (Exception $e) {
            $response_code = 500;
            $response_data = $this->responseData(
                false,
                $response_code,
                "Internal Server Error.",
                null,
                $e->getMessage()
            );
        }
        return new JsonResponse($response_data, $response_code);
    }

    /**
     * Get Campaign Details.
     *
     * @param int $campaign_id Campaign ID.
     * @return JsonResponse Application response.
     * @throws Exception
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function campaignDetails(int $campaign_id): JsonResponse
    {
        try {
            $campaign_data = $this->campaign_manager_service->campaignDetails($campaign_id);
            if ($this->emptyCheck($campaign_data)) {
                $response_code = 200;
                $response_data = $this->responseData(
                    true,
                    $response_code,
                    "Campaign details fetched successfully.",
                    $campaign_data
                );
            } else {
                $response_code = 404;
                $response_data = $this->responseData(
                    false,
                    $response_code,
                    "Not found.",
                    "",
                    "No campaign data found."
                );
            }
        } catch (Exception $e) {
            $response_code = 500;
            $response_data = $this->responseData(
                false,
                $response_code,
                "Internal Server Error.",
                null,
                $e->getMessage()
            );
        }
        return new JsonResponse($response_data, $response_code);
    }

    /**
     * Create campaign.
     *
     * @param CreateCampaign $request Http request.
     * @return JsonResponse Application response.
     * @throws Exception
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function createCampaign(CreateCampaign $request): JsonResponse
    {
        try {
            $validated_campaign_data = $request->validated();
            $campaign_data = $this->campaign_manager_service->createCampaign($validated_campaign_data);
            $response_code = 200;
            $response_data = $this->responseData(
                true,
                $response_code,
                "Campaign created successfully.",
                $campaign_data
            );
        } catch (Exception $e) {
            $response_code = 500;
            $response_data = $this->responseData(
                false,
                $response_code,
                "Internal Server Error.",
                null,
                $e->getMessage()
            );
        }
        return new JsonResponse($response_data, $response_code);
    }

    /**
     * Update campaign.
     *
     * @param UpdateCampaign $request Http request.
     * @param int $campaign_id Campaign ID.
     * @return JsonResponse Application response.
     * @throws Exception
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function updateCampaign(UpdateCampaign $request, int $campaign_id): JsonResponse
    {
        try {
            $validated_campaign_data = $request->validated();
            $campaign_data = $this->campaign_manager_service->updateCampaign($campaign_id, $validated_campaign_data);
            $response_code = 200;
            $response_data = $this->responseData(
                true,
                $response_code,
                "Campaign updated successfully.",
                $campaign_data
            );
        } catch (Exception $e) {
            $response_code = 500;
            $response_data = $this->responseData(
                false,
                $response_code,
                "Internal Server Error.",
                null,
                $e->getMessage()
            );
        }
        return new JsonResponse($response_data, $response_code);
    }

    /**
     * Delete campaign creatives.
     *
     * @param int $campaign_creative_id Campaign creative id.
     * @return JsonResponse Application response.
     * @throws Exception
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function deleteCampaignCreative(int $campaign_creative_id): JsonResponse
    {
        try {
            $campaign_creative = $this->campaign_manager_service->deleteCampaignCreative($campaign_creative_id);
            if ($campaign_creative) {
                $response_code = 200;
                $response_data = $this->responseData(
                    true,
                    $response_code,
                    "Successful.",
                    null,
                    "Campaign creative deleted successfully."
                );
            } else {
                throw new Exception("Campaign creative not deleted.");
            }
        } catch (Exception $e) {
            $response_code = 500;
            $response_data = $this->responseData(
                false,
                $response_code,
                "Internal Server Error.",
                null,
                $e->getMessage()
            );
        }
        return new JsonResponse($response_data, $response_code);
    }
}

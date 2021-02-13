<?php

namespace Tests\Unit\Services;

use App\Models\Campaign;
use App\Models\CampaignCreative;
use App\Repositories\Contracts\CampaignRepositoryInterface;
use App\Repositories\Contracts\CampaignCreativeRepositoryInterface;
use App\Services\CampaignManagerService;
use Tests\TestCase;

class CampaignManagerServiceTest extends TestCase
{
    private $campaign_manager_service;
    private $campaign_repository;
    private $campaign_creative_repository;

    protected function setUp(): void
    {
        $this->campaign_repository = $this->createMock(CampaignRepositoryInterface::class);
        $this->campaign_creative_repository = $this->createMock(CampaignCreativeRepositoryInterface::class);
        $this->campaign_manager_service = new CampaignManagerService(
            $this->campaign_repository,
            $this->campaign_creative_repository
        );
    }

    public function testCampaignListsFunction()
    {
        $campaign_list = [];
        $this->campaign_repository
            ->expects($this->any())
            ->method('campaignLists')
            ->willReturn($campaign_list);

        $response = $this->campaign_manager_service->campaignLists();
        $this->assertSame($campaign_list, $response);
    }

    public function testCampaignDetailsFunction()
    {
        $campaign_id = 1;
        $campaign_data = [];
        $this->campaign_repository
            ->expects($this->any())
            ->method('campaignDetails')
            ->with($campaign_id)
            ->willReturn($campaign_data);

        $response = $this->campaign_manager_service->campaignDetails($campaign_id);
        $this->assertSame($campaign_data, $response);
    }
}

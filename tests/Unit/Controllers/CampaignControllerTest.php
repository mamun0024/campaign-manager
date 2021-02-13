<?php

namespace Tests\Unit\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\CampaignController;
use App\Services\CampaignManagerServiceInterface;
use Tests\TestCase;

class CampaignControllerTest extends TestCase
{
    private $campaign_manager_service;
    private $campaign_controller;

    protected function setUp(): void
    {
        $this->campaign_manager_service = $this->createMock(CampaignManagerServiceInterface::class);
        $this->campaign_controller = new CampaignController(
            $this->campaign_manager_service
        );
    }

    public function testCampaignLists404NotFound()
    {
        $campaign_list = [];
        $this->campaign_manager_service
            ->expects($this->any())
            ->method('campaignLists')
            ->willReturn($campaign_list);

        $response = $this->campaign_controller->campaignLists();
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertSame(404, $response->original['code']);
        $this->assertSame('Not found.', $response->original['message']);
    }

    public function testCampaignLists200Ok()
    {
        $campaign_list = [
            "id" => 1,
            "name" => "Campaign Name"
        ];
        $this->campaign_manager_service
            ->expects($this->any())
            ->method('campaignLists')
            ->willReturn($campaign_list);

        $response = $this->campaign_controller->campaignLists();
        $this->assertSame(200, $response->original['code']);
        $this->assertSame('Campaign lists fetched successfully.', $response->original['message']);
    }

    public function testCampaignLists500ServerError()
    {
        $this->campaign_manager_service
            ->expects($this->any())
            ->method('campaignLists')
            ->willThrowException(new Exception());
        $response = $this->campaign_controller->campaignLists();
        $this->assertSame('Internal Server Error.', $response->original['message']);
    }
}

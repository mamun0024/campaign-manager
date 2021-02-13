<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\CreateCampaign;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class CreateCampaignRequestTest extends TestCase
{
    public function testCreateCampaignInputValidation()
    {
        $create_campaign_request = new CreateCampaign();

        $request1 = [
            "name"         => "",
            "from_date"    => "",
            "to_date"      => "",
            "total_budget" => "",
            "daily_budget" => "",
            "creatives"    => []
        ];
        $response1 = Validator::make(
            $request1,
            $create_campaign_request->rules()
        )->errors();
        $this->assertStringContainsString('The name field is required.', $response1);
        $this->assertStringContainsString('The from date field is required.', $response1);
        $this->assertStringContainsString('The to date field is required.', $response1);
        $this->assertStringContainsString('The total budget field is required.', $response1);
        $this->assertStringContainsString('The daily budget field is required.', $response1);
        $this->assertStringContainsString('The creatives field is required.', $response1);

        $request2 = [
            "name"         => "Campaign Name, Campaign Name, Campaign Name,
                                Campaign Name, Campaign Name, Campaign Name, Campaign Name,
                                Campaign Name, Campaign Name, Campaign Name, Campaign Name,
                                Campaign Name, Campaign Name, Campaign Name, Campaign Name,
                                Campaign Name, Campaign Name, Campaign Name, Campaign Name,
                                Campaign Name, Campaign Name, Campaign Name, Campaign Name,
                                Campaign Name, Campaign Name, Campaign Name, Campaign Name,
                                Campaign Name, Campaign Name",
            "from_date"    => "20-01-2021",
            "to_date"      => "20-02-2021",
            "total_budget" => "50000zaq",
            "daily_budget" => "500zaq",
            "creatives"    => [
                UploadedFile::fake()->image('campaign_creative_image_1.jpg'),
                UploadedFile::fake()->image('campaign_creative_image_2.docx')
            ]
        ];
        $response2 = Validator::make(
            $request2,
            $create_campaign_request->rules()
        )->errors();
        $this->assertStringContainsString('The name may not be greater than 250 characters.', $response2);
        $this->assertStringContainsString('The from date does not match the format Y-m-d.', $response2);
        $this->assertStringContainsString('The to date does not match the format Y-m-d.', $response2);
        $this->assertStringContainsString('The total budget must be a number.', $response2);
        $this->assertStringContainsString('The daily budget must be a number.', $response2);
        $this->assertStringContainsString('The creatives.1 must be a file of type: jpg, jpeg, png.', $response2);

        $request3 = [
            "name"         => "Campaign Name",
            "from_date"    => "2021-01-01",
            "to_date"      => "2021-12-31",
            "total_budget" => "50000.50",
            "daily_budget" => "500.50",
            "creatives"    => [
                UploadedFile::fake()->image('campaign_creative_image_3.jpg'),
                UploadedFile::fake()->image('campaign_creative_image_4.png'),
                UploadedFile::fake()->image('campaign_creative_image_5.jpeg')
            ]
        ];
        $response3 = Validator::make(
            $request3,
            $create_campaign_request->rules()
        );
        $this->assertTrue($response3->passes());
    }
}

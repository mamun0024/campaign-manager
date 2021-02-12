<?php

use App\Http\Controllers\CampaignController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Api', 'prefix' => 'v1', 'as' => 'api.'], function () {
    Route::get(
        '/campaigns',
        [CampaignController::class, 'campaignLists']
    );
    Route::get(
        '/campaign/{campaign_id}',
        [CampaignController::class, 'campaignDetails']
    );
    Route::post(
        '/campaign/create',
        [CampaignController::class, 'createCampaign']
    );
    Route::post(
        '/campaign/{campaign_id}/update',
        [CampaignController::class, 'updateCampaign']
    );
    Route::delete(
        '/campaign/creative/{creative_id}/delete',
        [CampaignController::class, 'deleteCampaignCreative']
    );
});

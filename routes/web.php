<?php

use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get(
    '/',
    [ViewController::class, 'campaignList']
)->name('campaign.list');

Route::get(
    '/campaign/create',
    [ViewController::class, 'createCampaign']
)->name('create.campaign');

Route::get(
    '/campaign/{campaign_id}/update',
    [ViewController::class, 'updateCampaign']
);

<?php

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

Route::get('/', 'App\Http\Controllers\ViewController@campaignList')->name('campaign.list');
Route::get('/campaign/create', 'App\Http\Controllers\ViewController@createCampaign')->name('create.campaign');
Route::get('/campaign/{campaign_id}/update', 'App\Http\Controllers\ViewController@updateCampaign');

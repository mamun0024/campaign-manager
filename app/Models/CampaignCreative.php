<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignCreative extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | ATTRIBUTES
    |--------------------------------------------------------------------------
    */
    public const CREATIVE_ID          = 'id';
    public const CREATIVE_CAMPAIGN_ID = 'campaign_id';
    public const CREATIVE_FILE_NAME   = 'file_name';
    public const CREATIVE_FILE_PATH   = 'file_path';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::CREATIVE_CAMPAIGN_ID,
        self::CREATIVE_FILE_NAME,
        self::CREATIVE_FILE_PATH,
    ];
}

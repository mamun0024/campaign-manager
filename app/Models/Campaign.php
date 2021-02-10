<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campaign extends Model
{
    use HasFactory;

    /*
   |--------------------------------------------------------------------------
   | ATTRIBUTES
   |--------------------------------------------------------------------------
   */
    public const CAMPAIGN_ID           = 'id';
    public const CAMPAIGN_NAME         = 'name';
    public const CAMPAIGN_FROM_DATE    = 'from_date';
    public const CAMPAIGN_TO_DATE      = 'to_date';
    public const CAMPAIGN_TOTAL_BUDGET = 'total_budget';
    public const CAMPAIGN_DAILY_BUDGET = 'daily_budget';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::CAMPAIGN_NAME,
        self::CAMPAIGN_FROM_DATE,
        self::CAMPAIGN_TO_DATE,
        self::CAMPAIGN_TOTAL_BUDGET,
        self::CAMPAIGN_DAILY_BUDGET,
    ];

    /**
     * This will return all the creatives associates with campaign
     *
     * @return HasMany
     */
    public function creatives(): HasMany
    {
        return $this->hasMany(CampaignCreative::class);
    }
}

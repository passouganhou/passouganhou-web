<?php

namespace App\Models\Rd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    protected $fillable = [
        '_id',
        'id',
        'name',
        'amount_montly',
        'amount_unique',
        'amount_total',
        'prediction_date',
        'markup',
        'last_activity_at',
        'interactions',
        'markup_last_activities',
        'created_at',
        'updated_at',
        'rating',
        'markup_created',
        'last_activity_content',
        'user_changed',
        'hold',
        'win',
        'closed_at',
        'stop_time_limit',
        'user',
        'deal_stage',
        'deal_source',
        'campaign',
        'next_task',
        'contacts',
        'deal_custom_fields',
        'deal_products',
    ];

    // Accessors
    public function getUserAttribute($value)
    {
        return (object) $value;
    }

    public function getDealStageAttribute($value)
    {
        return (object) $value;
    }

    public function getDealSourceAttribute($value)
    {
        return (object) $value;
    }

    public function getCampaignAttribute($value)
    {
        return (object) $value;
    }

    public function getNextTaskAttribute($value)
    {
        return (object) $value;
    }

    public function getContactsAttribute($value)
    {
        return (object) $value;
    }

    public function getDealCustomFieldsAttribute($value)
    {
        return (object) $value;
    }

    public function getDealProductsAttribute($value)
    {
        return (object) $value;
    }

}

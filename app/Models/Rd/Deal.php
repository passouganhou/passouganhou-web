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

    public array $proposalField = ['label' => 'Proposta', 'id' => '66184e4d3cf3650016b39c56'];

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
        return collect($value)->map(function ($field) {
            $field['custom_field']['value'] = $field['value'];
            return (object) $field['custom_field'];
        })->toArray();
    }

    //set custom field value by id
    public function setDealCustomFreeTextFieldById(string $id, $value)
    {
        $customField = collect($this->deal_custom_fields)->firstWhere('_id', $id);
        if ($customField) {
            $customField->value = $value;
        }
    }

    public function getDealCustomFieldIdByLabel(string $label)
    {
        $customField = collect($this->deal_custom_fields)->firstWhere('label', $label);
        return $customField?->_id;
    }

    public function getdealCustomFieldById(string $id)
    {
        $customField = collect($this->deal_custom_fields)->firstWhere('_id', $id);
        return $customField;
    }

    public function getDealProductsAttribute($value)
    {
        return (object) $value;
    }

}

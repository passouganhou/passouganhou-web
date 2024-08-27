<?php

namespace App\Models\DataWarehouse\Gsurf;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $table = 'gsurf_payments';

    protected $fillable = [
        'unique_id',
        'creation_date',
        'payment_date',
        'terminal_number',
        'channel',
        'customer_id',
        'import_date',
        'order_id',
        'merchant_usn',
        'payer_id',
        'payer_name',
        'gsetef_merchant_id',
        'last_settlement_date',
        'settlement_status',
        'dynamic_data',
        'split_data',
        'status_id',
        'status_description',
        'type_id',
        'type_description',
        'sale_type_id',
        'sale_type_description',
        'amount',
        'amount_currency',
        'original_amount',
        'original_amount_currency',
        'amount_paid',
        'amount_paid_currency',
        'merchant_amount',
        'merchant_amount_currency',
        'merchant_amount_paid',
        'merchant_amount_paid_currency',
        'adjustment_amount',
        'adjustment_amount_currency',
    ];

    // Accessors
    public function getCreationDateAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function getImportDateAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function getLastSettlementDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('Y-m-d') : null;
    }

    public function getPaymentDateAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    // Mutators
    public function setCreationDateAttribute($value)
    {
        $this->attributes['creation_date'] = Carbon::parse($value);
    }

    public function setImportDateAttribute($value)
    {
        $this->attributes['import_date'] = Carbon::parse($value);
    }

    public function setLastSettlementDateAttribute($value)
    {
        $this->attributes['last_settlement_date'] = $value ? Carbon::parse($value) : null;
    }

    public function setPaymentDateAttribute($value)
    {
        $this->attributes['payment_date'] = Carbon::parse($value);
    }

}

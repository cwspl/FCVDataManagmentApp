<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriptionCharges extends Model
{
    protected $table = 'subscription_charges';
    public $timestamps = false;
    protected $primaryKey = 'charge_id';
    protected $fillable = [
        'charge_id',
        'customer_id',
        'charge_amount',
        'charge_started_at',
        'charge_created_at',
        'charge_updated_at',
    ];
}

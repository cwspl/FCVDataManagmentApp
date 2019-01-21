<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'customer_id';
    protected $fillable = [
        'customer_id',
        'area_id',
        'customer_name',
        'customer_name_english',
        'customer_mobile_number',
        'customer_status',
        'customer_created_at',
        'customer_updated_at',
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class paidAmount extends Model
{
    protected $table = 'paid';
    public $timestamps = false;
    protected $primaryKey = 'paid_id';
    protected $fillable = [
        'paid_id',
        'customer_id',
        'paid_amount',
        'paid_at',
        'paid_created_at',
        'paid_updated_at',
    ];
}

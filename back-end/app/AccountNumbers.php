<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountNumbers extends Model
{
    protected $table = 'account_numbers';
    public $timestamps = false;
    protected $primaryKey = 'account_number_id';
    protected $fillable = [
        'account_number_id',
        'customer_id',
        'account_number',
        'account_status',
        'account_expired_at',
        'account_created_at',
        'account_updated_at',
    ];
}

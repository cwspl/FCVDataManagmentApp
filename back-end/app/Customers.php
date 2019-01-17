<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $primaryKey = 'customer_id';
    protected $fillable = ['customer_id'];
}

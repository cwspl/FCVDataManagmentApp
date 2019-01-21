<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areas';
    public $timestamps = false;
    protected $primaryKey = 'area_id';
    protected $fillable = [
        'area_id',
        'area_name',
        'area_name_english',
        'area_created_at',
        'area_updated_at',
    ];
}

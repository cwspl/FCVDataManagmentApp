<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentArea extends Model
{
    protected $table = 'agent_areas';
    public $timestamps = false;
    protected $primaryKey = 'agent_area_id';
    protected $fillable = [
        'agent_area_id',
        'agent_id',
        'area_id',
        'agent_area_created_at',
        'agent_area_updated_at',
    ];
}

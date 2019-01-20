<?php

namespace App;

use Laravel\Passport\HasApiTokens;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CityAgent extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'city_agents';
    protected $primaryKey = 'agent_id';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'agent_name', 'agent_email_address', 'agent_phone_number', 'password', 'agent_created_at', 'agent_updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
    public function getAuthPassword()
    {
      return $this->password;
    }
}

?>

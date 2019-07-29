<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{
	protected $fillable = [
        'id', 
        'first_name', 
        'last_name', 
        'email', 
        'password'
    ];
	public function investments()
    {
        return $this->hasMany('App\Investment', 'investor_id', 'id');
    }
}

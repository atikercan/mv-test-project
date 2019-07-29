<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	protected $table = 'companies';
    protected $primaryKey = 'id';
	
	protected $fillable = [
        'id', 
        'name', 
        'logo' 
    ];
	
	public function investments()
    {
        return $this->hasMany('App\Investment', 'company_id', 'id');
    }
}

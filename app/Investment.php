<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
	protected $fillable = [
        'id', 
        'company_id', 
        'investor_id',
        'amount',
        'fees'
    ];
    /**
     * An investment belongs to an Investor
     *
     * @return BelongsTo
     */
    public function investor()
    {
        return $this->belongsTo(Investor::class);
    }
	public function company()
    {
        return $this->belongsTo('App\Company', 'company_id', 'id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    /**
     * Get the multimedia for the campaign.
     */
    protected $fillable = ['title', "product_id","vendor_id", 'start_date', "end_date", "status","approved_by", "created_by", "updated_by"];


    public function multimedia()
    {
        return $this->hasMany('App\MultiMedia');
    }

    /**
     * Get the history for the campaign.
     */
    public function histories()
    {
        return $this->hasMany('App\CampaignHistory');
    }

    /**
     * Get the language that owns the campaign.
     */
    public function language()
    {
        return $this->belongsTo('App\Language');
    }

    /**
     * Get the product that owns the campaign.
     */
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}

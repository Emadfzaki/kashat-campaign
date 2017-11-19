<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampaignHistory extends Model
{
    /**
     * Get the campaign that owns the campaign history.
     */
    public function campaign()
    {
        return $this->belongsTo('App\Campaign');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    /**
     * Get the multimedia for the media.
     */
    public function multimedia()
    {
        return $this->hasMany('App\MultiMedia');
    }
}

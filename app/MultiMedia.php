<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MultiMedia extends Model
{
    /**
     * Get the media that owns the multimedia.
     */
    public function media()
    {
        return $this->belongsTo('App\Media');
    }

    /**
     * Get the campaign that owns the multimedia.
     */
    public function campaign()
    {
        return $this->belongsTo('App\Campaign');
    }

    /**
     * Get the category that owns the multimedia.
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * Get the product that owns the multimedia.
     */
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}

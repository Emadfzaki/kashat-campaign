<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Get the multimedia for the product.
     */
    public function multimedia()
    {
        return $this->hasMany('App\MultiMedia', 'content_id')->where("content_type", "product")->get();
    }

    /**
     * Get the translations for the product.
     */
    public function translations()
    {
        return $this->hasMany('App\ProductTranslation')->get();
    }

    /**
     * Get the campaigns for the product.
     */
    public function campaigns()
    {
        return $this->hasMany('App\Campaign');
    }

    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}

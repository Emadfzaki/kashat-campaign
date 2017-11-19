<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    /**
     * Get the product that owns the translation.
     */
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    /**
     * Get the language that owns the translation.
     */
    public function language()
    {
        return $this->belongsTo('App\Language');
    }
}

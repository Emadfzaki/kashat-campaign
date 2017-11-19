<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    /**
     * Get the campaigns for the language.
     */
    public function campaigns()
    {
        return $this->hasMany('App\Campaign');
    }

    /**
     * Get the categories translations for the language.
     */
    public function categories_translations()
    {
        return $this->hasMany('App\CategoryTranslation');
    }

    /**
     * Get the products translations for the language.
     */
    public function products_translations()
    {
        return $this->hasMany('App\ProductTranslation');
    }
}

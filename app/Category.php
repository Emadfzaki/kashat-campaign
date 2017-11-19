<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Get the multimedia for the category.
     */
    public function multimedia()
    {
        return $this->hasMany('App\MultiMedia');
    }

    /**
     * Get the translations for the category.
     */
    public function translations()
    {
        return $this->hasMany('App\CategoryTranslation');
    }

    /**
     * Get the products for the category.
     */
    public function products()
    {
        return $this->hasMany('App\Product');
    }
}

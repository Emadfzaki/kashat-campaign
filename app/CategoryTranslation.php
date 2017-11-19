<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    /**
     * Get the category that owns the category translation.
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * Get the language that owns the category translation.
     */
    public function language()
    {
        return $this->belongsTo('App\Language');
    }
}

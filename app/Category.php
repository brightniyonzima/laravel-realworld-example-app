<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name','parent_category_id'
    ];

    // Get the associated article
    public function articles() {
        return $this->hasMany('App\Article');
    }
}

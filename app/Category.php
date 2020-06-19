<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function superMarket()
    {
        return $this->belongsTo('App\SuperMarket');
    }

    public function items()
    {
        return $this->hasMany('App\Item');
    }
}

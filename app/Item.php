<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function superMarket()
    {
        return $this->belongsTo('App\SuperMarket');
    }

    public function stocks()
    {
        return $this->hasMany('App\Stock')->orderBy('id', 'desc');
    }
}

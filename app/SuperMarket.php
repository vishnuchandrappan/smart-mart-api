<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuperMarket extends Model
{
    protected $guarded = [];

    protected $hidden = ['user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function district()
    {
        return $this->belongsTo('App\District');
    }

    public function labels()
    {
        return $this->hasManyThrough('App\Label', 'App\Item');
    }

    public function items()
    {
        return $this->hasMany('App\Item');
    }

    public function outOfStock()
    {
        return $this->items()->where('stock', 0);
    }

    public function lowStock()
    {
        return $this->items()->where('stock', '<=', 100)->where('stock', '>', 0);
    }
}

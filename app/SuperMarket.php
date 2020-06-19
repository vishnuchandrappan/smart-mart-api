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

    public function categories()
    {
        return $this->hasMany('App\Category');
    }
}

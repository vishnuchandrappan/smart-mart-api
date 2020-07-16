<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    //
    protected $guarded = [];

    public function items()
    {
        return $this->hasMany('App\Label');
    }

    public function selectedItems($id)
    {
        return $this->items()->where('super_market_id', $id);
    }
}

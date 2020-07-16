<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = ['name'];

    public function theaters()
    {
        return $this->hasMany('App\Theater')->orderBy('id');
    }

    public function movies()
    {
        return $this->theaters()->with('movies');
    }
}

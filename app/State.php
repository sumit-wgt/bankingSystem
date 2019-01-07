<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $guarded = [];

    public function countries()
    {
        return $this->belongsTo('App\Country','country_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funder extends Model
{
    //

    public function fundings()
    {
        return $this->belongsToMany(Funding::class, 'funder_funding');
    }

    public function travelgrants()
    {
        return $this->belongsToMany(TravelGrant::class, 'funder_travelgrant');
    }
}

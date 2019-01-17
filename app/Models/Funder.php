<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Funder extends Model
{
    //

    protected $guarded = [
        'id',
    ];
    

    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function fundings()
    {
        return $this->belongsToMany(Funding::class, 'funder_funding');
    }

    public function travelgrants()
    {
        return $this->belongsToMany(TravelGrant::class, 'funder_travelgrant');
    }
}

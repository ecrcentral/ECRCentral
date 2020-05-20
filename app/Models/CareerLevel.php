<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class CareerLevel extends Model
{
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

    /**
     * The careerlevel that belong to the travel grant.
     */
    public function travelgrants()
    {
        return $this->belongsToMany(TravelGrant::class, 'careerlevel_travelgrant');
    }

    /**
     * The careerlevel that belong to the funding.
     */
    public function fundings()
    {
        return $this->belongsToMany(Funding::class, 'careerlevel_funding');
    }

    public function parentId()
    {
        return $this->belongsTo(self::class);
    }

    
}

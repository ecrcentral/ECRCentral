<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class TravelPurpose extends Model
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
     * The purpose that belong to the travel grant.
     */
    public function travelgrants()
    {
        return $this->belongsToMany(TravelGrant::class, 'travelpurpose_travelgrant');
    }

    public function parentId()
    {
        return $this->belongsTo(self::class);
    }

    
}

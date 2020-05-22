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
     * The purpose that belong to the funding.
     */
    public function fundings()
    {
        return $this->belongsToMany(Funding::class, 'fundingpurpose_funding');
    }

    public function parentId()
    {
        return $this->belongsTo(self::class);
    }

    
}

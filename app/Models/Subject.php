<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Subject extends Model
{
    
    protected $table = 'subjects';

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
     * The subjects that belong to the funding.
     */
    public function fundings()
    {
        return $this->belongsToMany(Funding::class, 'subject_funding');
    }

     /**
     * The subjects that belong to the travel grant.
     */
    public function travelgrants()
    {
        return $this->belongsToMany(TravelGrant::class, 'subject_travelgrant');
    }

    public function parentId()
    {
        return $this->belongsTo(self::class);
    }
}

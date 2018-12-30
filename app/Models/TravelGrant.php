<?php

namespace App\Models;

use Laravel\Scout\Searchable;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class TravelGrant extends Model
{
    use Searchable;

    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'travel_grants_index';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Customize array...

        $funders = "";

        return $array;
    }

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
     * The subjects that belong to the travel grants.
     */
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_travelgrant');

    }

    /**
     * The funders that belong to the funding.
     */
    public function funders()
    {
        return $this->belongsToMany(Funder::class, 'funder_travelgrant');

    }
}

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

    public function isPublished()
    {
        return $this->status !== 0;
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        
        if (! $this->isPublished()) {
            $this->unsearchable();
            return [];
        }

        $array = $this->toArray();

        // Customize array...

        $extraFields = [
            'travel_purpose' => $this->purposes->pluck('name')->toArray(),
            'career_levels' => $this->career_levels->pluck('name')->toArray(),
            'funders' => $this->funders->pluck('name')->toArray(),
            'logos' => $this->funders->pluck('logo')->toArray(),
        ];

        return array_merge($array, $extraFields);
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
     * The purpose that belong to the travel grants.
     */
    public function purposes()
    {
        return $this->belongsToMany(TravelPurpose::class, 'travelpurpose_travelgrant');

    }

    /**
     * The purpose that belong to the travel grants.
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
        return $this->belongsToMany(Funder::class, 'funder_travelgrant')->where('status', '=', 1)->orderBy('name');

    }
}

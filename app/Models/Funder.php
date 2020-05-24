<?php

namespace App\Models;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Funder extends Model
{
    use Searchable;

    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'funders_index';
    }

    public function isPublished()
    {
        return ($this->status === 1);
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
        if ($this->dora == 1)
        {
            $this->dora == "Yes";
        }
        if ($this->dora == 0)
        {
            $this->dora == "No";
        } 

        $array = $this->toArray();

        // Customize array...
        $extraFields = [
        
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

    public function fundings()
    {
        return $this->belongsToMany(Funding::class, 'funder_funding');
    }

    public function travelgrants()
    {
        return $this->belongsToMany(TravelGrant::class, 'funder_travelgrant');
    }
}

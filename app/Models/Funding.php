<?php

namespace App\Models;

use Laravel\Scout\Searchable;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Funding extends Model
{
    use Searchable;

    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'fundings_index';
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
            'funders' => $this->funders->pluck('name')->toArray(),
            'subjects' => $this->subjects->pluck('name')->toArray(),
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
     * The subjects that belong to the funding.
     */
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_funding');

    }

    /**
     * The funders that belong to the funding.
     */
    public function funders()
    {
        return $this->belongsToMany(Funder::class, 'funder_funding')->where('status', '=', 1)->orderBy('name');

    }

}

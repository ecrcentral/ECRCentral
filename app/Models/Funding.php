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

        $array = $this->toArray();

        // Customize array...
        $extraFields = [
            'funders' => $this->funders->pluck('name')->toArray(),
            'subjects' => $this->subjects->pluck('name')->toArray(),
            'career_levels' => $this->career_levels->pluck('name')->toArray(),
            'logos' => $this->funders->pluck('logo')->toArray(),
            'funding_purpose' => $this->purposes->pluck('name')->toArray(),
            'deadlines' => $this->pluck('deadline')->explode(',')->toArray(),
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
     * The career_levels that belong to the funding.
     */
    public function career_levels()
    {
        return $this->belongsToMany(CareerLevel::class, 'careerlevel_funding');

    }

    /**
     * The funders that belong to the funding.
     */
    public function funders()
    {
        return $this->belongsToMany(Funder::class, 'funder_funding')->where('status', '=', 1)->orderBy('name');

    }

    /**
     * The purpose that belong to the funding.
     */
    public function purposes()
    {
        return $this->belongsToMany(FundingPurpose::class, 'fundingpurpose_funding');

    }

}

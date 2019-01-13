<?php

namespace App\Models;

use Laravel\Scout\Searchable;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Resource extends Model
{
    use Searchable;

    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'resources_index';
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
            'categories' => $this->categories->pluck('name')->toArray(),
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
     * The category that belong to the resource.
     */
    public function categories()
    {
        return $this->belongsToMany(ResourceCategory::class, 'resource_category_resource');

    }

    
}

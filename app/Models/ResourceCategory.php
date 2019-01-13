<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class ResourceCategory extends Model
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
     * The category that belong to the resource.
     */
    public function resources()
    {
        return $this->belongsToMany(Resource::class, 'resource_category_resource');
    }

    public function parentId()
    {
        return $this->belongsTo(self::class);
    }
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    protected $fillable = ['name', 'slug', 'description', 'level'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}

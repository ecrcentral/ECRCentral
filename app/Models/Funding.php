<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funding extends Model
{
    /**
     * The users that belong to the role.
     */
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_funding');

    }
}

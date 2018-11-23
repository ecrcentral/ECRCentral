<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
     /**
     * The users that belong to the role.
     */
    public function fundings()
    {
        return $this->belongsToMany(Funding::class, 'subject_funding');
    }
}

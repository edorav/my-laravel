<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'address','city', 'postcode'
    ];

    /**
     * The users that belong to the agency.
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}

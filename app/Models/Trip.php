<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'label'
    ];

     /**
     * The users that belong to the trip.
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\Trip');
    }

    /**
     * Get the tripdays for the trip.
     */
    public function tripdays()
    {
        return $this->hasMany('App\Models\TripDay');
    }


}

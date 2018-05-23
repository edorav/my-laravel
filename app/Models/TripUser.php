<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripUser extends Model
{
    //
    protected $table = 'trip_user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trip_id', 'user_id'
    ];

    public function trip()
    {
        return $this->belongsTo('App\Models\Trip');
    }
}

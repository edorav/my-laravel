<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripDay extends Model
{
    //
    protected $table = 'trip_day';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'from' , 'to' ,'trip_id', 'city_id'
    ];

    public function trip()
    {
        return $this->belongsTo('App\Models\Trip');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }
}

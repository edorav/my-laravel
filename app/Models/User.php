<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Spatie\Permission\Traits\HasRoles;
use Hootlex\Friendships\Traits\Friendable;

class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;
    use Friendable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'password', 'cellnumber' , 'locale' , 'currencycode','api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getProfilePicture()
    {
        return asset('storage/' . $this->picture . '/default.jpg');
    }

    /**
     * The agencies that belong to the user.
     */
    public function trips()
    {
        return $this->belongsToMany('App\Models\Trip');
    }


}

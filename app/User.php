<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
//    use Notifiable;
    use EntrustUserTrait;
//    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'username', 'password', 'email', 'phone', 'address'];

    public function getRouteKey()
    {
        $hashids = app()->make('Hashids');

        return $hashids->encode($this->getKey());
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
//    protected $hidden = ['password', 'remember_token'];
    protected $hidden = ['remember_token'];

    public function roles() {
        return $this->belongsToMany('App\Role');
    }

}

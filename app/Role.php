<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    //

    public function getRouteKey()
    {
        $hashids = app()->make('Hashids');

        return $hashids->encode($this->getKey());
    }

    public function users() {
        return $this->belongsToMany('App\User');
    }

    public function permissions() {
        return $this->belongsToMany('App\Permission');
    }

}

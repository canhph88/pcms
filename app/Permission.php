<?php

namespace App;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    public function getRouteKey()
    {
        $hashids = app()->make('Hashids');

        return $hashids->encode($this->getKey());
    }

    //
    public function roles() {
        return $this->belongsToMany('App\Role');
    }

}

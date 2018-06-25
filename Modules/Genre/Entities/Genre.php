<?php

namespace Modules\Genre\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genre extends Model
{
    use SoftDeletes;
    //
    protected $fillable = ['id', 'name', 'description'];

    public function getRouteKey()
    {
        $hashids = app()->make('Hashids');

        return $hashids->encode($this->getKey());
    }

    public function books() {
        return $this->belongsToMany('Modules\Book\Entities\Book');
    }
}

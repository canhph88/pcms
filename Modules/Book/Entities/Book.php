<?php

namespace Modules\Book\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;
    //
    protected $fillable = ['id', 'name', 'image', 'description', 'quantity', 'price'];

    public function getRouteKey()
    {
        $hashids = app()->make('Hashids');

        return $hashids->encode($this->getKey());
    }

    public function authors()
    {
        return $this->belongsToMany('Modules\Author\Entities\Author');
    }

    public function genres()
    {
        return $this->belongsToMany('Modules\Genre\Entities\Genre');
    }
}

<?php

namespace Modules\SMS\Entities;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    const SUCCESS   = "SUCCESS";
    const FAILED   = "FAILED";
    const ERROR   = "ERROR";
    const TESTING   = "TESTING";

    protected $fillable = [];
}

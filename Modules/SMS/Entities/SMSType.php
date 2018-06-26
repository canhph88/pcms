<?php

namespace Modules\SMS\Entities;

use Illuminate\Database\Eloquent\Model;

class SMSType extends Model
{
    const INPUT = 0;
    const FILE  = 1;

    public static function getType($type) {
        if ($type == SMSType::INPUT) {
            return SMSType::INPUT;
        }
        return SMSType::FILE;
    }
}

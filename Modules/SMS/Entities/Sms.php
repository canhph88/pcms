<?php

namespace Modules\SMS\Entities;

use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    public $timestamps = false;

    protected $fillable = ['phones', 'invalid_phones', 'duplicate_phones',  'content', 'status', 'returned_msg', 'created_at'];

    public static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {
            $model->created_at = $model->freshTimestamp();
        });
    }

    public static function validatePhone($number) {
        $number = trim($number);

        if (preg_match('#[^0-9]#', $number)) {
            return false;
        }

        $length = strlen($number);
        $query = "65";
        if (substr($number, 0, strlen($query)) === $query && ($length >= 8 && $length <= 12)) {
            return true;
        }

        return false;
    }

    public static function multiExplode($delims, $string, $special = '|||') {

        if (is_array($delims) == false) {
            $delims = array($delims);
        }

        if (empty($delims) == false) {
            foreach ($delims as $d) {
                $string = str_replace($d, $special, $string);
            }
        }

        return explode($special, $string);
    }

    public static function removeBomUtf8($s){
        if(substr($s,0,3)==chr(hexdec('EF')).chr(hexdec('BB')).chr(hexdec('BF'))){
            return substr($s,3);
        }else{
            return $s;
        }
    }

    public static function ellipsis($phones) {
        $phonesArr = explode(',', $phones);
        if (count($phonesArr) < 10) {
            return $phones;
        }
        return implode(', ', array_slice($phonesArr, 0, 10)) .'...';
    }

    public static function getBySearchAndStatus($search, $statusFilter)
    {

    }
}

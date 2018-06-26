<?php

namespace Modules\SMS\Libraries;


class SMSMobileFilter {

    private $rawMobiles;
    private $checkedMobiles = [];
    private $validMobiles = [];
    private $invalidMobiles = [];
    private $duplicateMobiles = [];

    public function __construct($rawMobiles)
    {
        $this->rawMobiles = $rawMobiles;
    }

    public function doFilter() {
        $index = 0;
        foreach ($this->rawMobiles as $item) {
            $item = $this->removeBomUtf8($item);
            if ($this->validatePhone($item) && $index < 1000) {
                array_push($this->checkedMobiles, $item);
                $index++;
            }
            else {
                array_push($this->invalidMobiles, strip_tags($item));
            }
            if ($index >= 1000) {
                break;
            }
        }

        $this->invalidMobiles = array_unique( $this->invalidMobiles );
        $this->validMobiles = array_unique( $this->checkedMobiles, SORT_STRING );
        $this->duplicateMobiles = array_unique( array_diff_assoc( $this->checkedMobiles, $this->validMobiles ) );

        return $this;
    }

    public function getValid() {
        return $this->validMobiles;
    }

    public function getInvalid() {
        return $this->invalidMobiles;
    }

    public function getDuplicate() {
        return $this->duplicateMobiles;
    }

    public function isHasValidPhones() {
        return count($this->validMobiles) > 0;
    }

    private function removeBomUtf8($s){
        if(substr($s,0,3)==chr(hexdec('EF')).chr(hexdec('BB')).chr(hexdec('BF'))){
            return substr($s,3);
        }else{
            return $s;
        }
    }

    private function validatePhone($number) {
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

}

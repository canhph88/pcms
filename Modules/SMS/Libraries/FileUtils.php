<?php

namespace Modules\SMS\Libraries;

use ParseCsv\Csv;

class FileUtils {

    public static function readTxt($filePath) {
        $returnedArr = [];

        if ($file = fopen($filePath, "r")) {
            while(!feof($file)) {
                $line = fgets($file);
                foreach (explode(',', $line) as $item) {
                    if (!empty($item)) {
                        array_push($returnedArr, $item);
                    }
                }
            }
            fclose($file);
        }

        return $returnedArr;
    }

    public static function readCsv($filePath) {
        $returnedArr = [];

        $parseCsv = new Csv();
        $parseCsv->heading = false;
        $parseCsv->parse($filePath);
        $phoneArr = $parseCsv->data;

        foreach ($phoneArr as $key => $row) {
            foreach ($row as $value) {
                if (!empty($value)) {
                    array_push($returnedArr, $value);
                }
            }
        }

        return $returnedArr;
    }

}

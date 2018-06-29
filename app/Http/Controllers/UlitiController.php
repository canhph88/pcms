<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UlitiController extends Controller
{
    //
    public function ajaxWardList($id) {
        $districts = json_decode(file_get_contents(storage_path('app/public/hcm_area.json')));

        foreach ($districts as $d) {
            if ($d->id == $id) {
                return response()->json($d);
            }
        }

        return [];
    }
}

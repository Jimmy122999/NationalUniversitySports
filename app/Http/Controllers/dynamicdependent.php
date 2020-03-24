<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class dynamicdependent extends Controller
{
    public function fetch(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data = DB::table('divisions')->where($select, $value)->pluck('name', 'id');

        $output= '<option value="#" selected="true" disabled="disabled">Select Division</option>';

        foreach($data as $id => $value)
        {
            $output .= '<option value= "'.$id.'">'.$value.'</option>';
        }


        return $output;

    }
}

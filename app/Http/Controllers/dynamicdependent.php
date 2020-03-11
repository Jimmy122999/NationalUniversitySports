<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dynamicdependent extends Controller
{
    public function fetch(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data = DB::table('divisions')->where($select, $value)->groupBy($dependent)->get();

        $output= '<option value="">Select '.ucfirst($dependent).'</option>';

        foreach($data as $row)
        {
            $output .= '<option value= "'.$row->$dependent.'">
            '.$row->$dependent.'</option>';
            echo $output;
        }
        dd('sdfdsf');

    }
}

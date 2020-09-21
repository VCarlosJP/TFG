<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class compareDataController extends Controller
{

    //It calls to functions to check what is on a table but not in the other one.
    function callHashComparators(Request $request){
       
        

        $table_name = $request['table'];

        $left = app('App\Http\Controllers\databaseController')->dataLeftHashTable($table_name);

        $right = app('App\Http\Controllers\databaseController')->dataRightHashTable($table_name);
        
        return ['local-table'=>$left, 'external-table'=>$right];
        //return response()->json(['Left'=>$Left, 'Right'=>$Right]);
         
    }


}

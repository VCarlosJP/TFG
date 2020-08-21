<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReturnDataToFrontEndController extends Controller
{
    //It generates an array with the selected tables name´s as keys and their columns as values
    //to be passed to selectKey View.
    //Later on the view, the user needs to select wich columns will be ignored for the hashing process
    //of each table.
    function getColumnsFromSelectedTables($tables){
        $column_names = [];

        foreach ($tables as $current_table) {
            $column_names[$current_table] = app('App\Http\Controllers\databaseController')->getTableColumns($current_table);
        }
        
        return view('selectKey')->with('data', $column_names);
    }

    function getColumnsFromSelectedTablesCheckData(Request $request){

        $data = json_decode($request->input('Data'), true);
        $tables = $data;


        $column_names = [];
        foreach ($tables as $current_table) {

            app('App\Http\Controllers\databaseController')->createHashColumn($current_table);
            app('App\Http\Controllers\databaseController')->createHashColumn($current_table.config('global.test_table_standard'));

            
            app('App\Http\Controllers\databaseController')->createView($current_table);
            app('App\Http\Controllers\databaseController')->createView($current_table.config('global.test_table_standard'));


            $column_names[$current_table] = app('App\Http\Controllers\databaseController')->getTableColumns($current_table);
        }
        return view('checkData')->with('data', $column_names);
    }


    function getColumnType(Request $request){

        //$data = json_decode($request->input('data'), true);
        $request2 = $request->all();
        $request2 =  array_keys($request2);
        $request2 = json_decode($request2[0]);
        //dd($request2);
        
        $columnName = $request2->columnName;
        $tableName = $request2->tableName;

        $type = app('App\Http\Controllers\databaseController')->getColumnType($columnName, $tableName);

        return $type;

        //return $_GET["columnName"];

        //app('App\Http\Controllers\databaseController')->getTableColumns($current_table);


        // $column_names = [];
        // foreach ($tables as $current_table) {
        //     $column_names[$current_table] = app('App\Http\Controllers\databaseController')->getTableColumns($current_table);
        // }

        //return view('checkData')->with('data', $column_names);
    }

    function callVarcharResponseCheck(Request $request){
        $data = json_decode($request->input('Data'), true);

        $result = app('App\Http\Controllers\checkDataController')->checkVarcharMultiOperator($data[0],$data[1],$data[2],$data[3], $data[4]);
        
        //return count($result);
        
        return view('checkDataResults')->with('data', $result);
    }





    ////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////ELIMINAR////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////
    function callResponseCheck (Request $request){

        $data = json_decode($request->input('Data'), true);

        $result = app('App\Http\Controllers\checkDataController')->checkIntMultiOperator($data[0],$data[1],$data[2],$data[3]);
        
        //dd($result);
        return view('checkDataResults')->with('data', $result);
        //return view('comparison')->with('tables', $tables);
    }

}

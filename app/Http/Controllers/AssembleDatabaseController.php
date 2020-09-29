<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssembleDatabaseController extends Controller
{

    function chooseModeController(Request $request){
        $data = json_decode($request->input('Data'), true);
        $tables = $data['tables'];
        return view('chooseMode')->with('tables', $tables); 
    }

    //This function receives the names of the selected tables and database on the first view (mainPage),
    //then it calls createHashColumn wich is on charge of creating a new column for each table selected
    //and its tests tables.
    function createHashColumnsFromSelectedTables(Request $request){
      
        $data = json_decode($request->input('Data'), true);
        
        $tables = $data;

        foreach ($tables as $current_table) {
            app('App\Http\Controllers\databaseController')->createHashColumn($current_table);
            app('App\Http\Controllers\databaseController')->createHashColumn($current_table.'_test');
            app('App\Http\Controllers\databaseController')->createHashCountColumn($current_table);
            app('App\Http\Controllers\databaseController')->createHashCountColumn($current_table.'_test');
        }

        // foreach ($tables as $current_table) {
        //     app('App\Http\Controllers\databaseController')->createHashCountColumn($current_table);
        //     app('App\Http\Controllers\databaseController')->createHashCountColumn($current_table.'_test');
        // }

        return $this->createViewsFromSelectedTables($tables);
    }

    //The function creates views from original tables and its tests.
    function createViewsFromSelectedTables($tables){
        foreach ($tables as $current_table) {
            app('App\Http\Controllers\databaseController')->createView($current_table);
            app('App\Http\Controllers\databaseController')->createView($current_table.'_test');
        }

        return app('App\Http\Controllers\returnDataToFrontEndController')->getColumnsFromSelectedTables($tables);
    }
    
    //The controller works as an intermediary, performing the creation of hash values of all the rows
    //from the selected tables.
    function createHashInSelectedTables(Request $request){

        $data = json_decode($request->input('Data'), true);
        $tables = array_keys($data);

        
        
        foreach ($tables as $current_table) {
            app('App\Http\Controllers\databaseController')->createHashFromTable($current_table, $data[$current_table]);
            app('App\Http\Controllers\databaseController')->createHashFromTable($current_table.'_test', $data[$current_table]);
            app('App\Http\Controllers\databaseController')->countHashFromTable($current_table);
            app('App\Http\Controllers\databaseController')->countHashFromTable($current_table.'_test');
        }

        // foreach ($tables as $current_table) {
        //     app('App\Http\Controllers\databaseController')->countHashFromTable($current_table);
        //     app('App\Http\Controllers\databaseController')->countHashFromTable($current_table.'_test');
        // }

        // return var_dump($data);

         return view('comparison')->with('tables', $tables);
    }

    //This controller performs a cleaning in all the modifications maded to the selected tables.
    // It deletes the hash columns from local and external tables and it also deletes all the views created by the SAT. 
    function cleanDatabaseController(){
        $tables = app('App\Http\Controllers\databaseController')->getTablesNameFromSelectedDB();
        foreach ($tables as $table) {
            app('App\Http\Controllers\databaseController')->deleteHashColumn($table);
            
            app('App\Http\Controllers\databaseController')->deleteHashColumn($table."_test");
            app('App\Http\Controllers\databaseController')->deleteView($table."_view");
            
            app('App\Http\Controllers\databaseController')->deleteView($table."_test_view");
        }

        return redirect('/');

    }
}

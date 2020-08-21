<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('mainPage');
});

// Route::get('/', function () {
//     return view('chooseMode');
// });

Route::resource('testController', 'checkDataController'); //ruta interna solo para pruebas de controlador





// Route::get('/panel', function () {
//     return view('panel');
// });

//Route::resource('comparation', 'comparationController');
//Route::resource('testController', 'databaseController');
//Route::get('test', 'jsonToSQLController@getController');







//Route::get('del', 'jsonToSQLController@deleteRecordsController');
// Route::get("/main_content", function()
// {
//    return View::make("test", 'jsonToSQLController@testController');
// });
//Route::get('main_content', 'databaseController@dataLeftTables');
//Route::get('right', 'databaseController@dataRightTables');
//Route::get('testjson', 'createJsonController@testMethod');



Route::get('getDB', 'databaseController@getDataBaseName');
Route::get('getTablesName', 'databaseController@getTablesNameFromSelectedDB');

//Changes**
//Route::post('createJSON', 'createJsonController@createJSON'); //1
//********/
Route::post('chooseMode', 'AssembleDatabaseController@chooseModeController');
Route::post('assembleDatabase', 'AssembleDatabaseController@createHashColumnsFromSelectedTables');
Route::post('setDataToCompare', 'AssembleDatabaseController@createHashInSelectedTables');

Route::post('resetPresentacionBD', 'AssembleDatabaseController@cleanDatabaseController');

//Route::get('getDataResponse/{xx}', 'dataResponseController@getDataResponse');
//Route::get('getColumnsNameFromTables', 'dataResponseController@getColumnsNameFromTables');

//selectKey View
// Route::get('selectKey', function () {
//     return view('selectKey');
// })->name('redirectSelectKey');

//Route::post('compareData', 'compareDataController@compareData');

Route::post('callHashComparators', 'compareDataController@callHashComparators');

//Calls for development

    //Fill Base Table
        //Route::get('fill', 'fillTablesController@fill');

    //Empty Base Table
        //Route::get('delete', 'fillTablesController@delete');


//Route::get('callToHashController', 'dataResponseController@callToHashController')->name('callToHashController');

Route::post('checkData', 'ReturnDataToFrontEndController@getColumnsFromSelectedTablesCheckData');

Route::post('postCheckData', 'ReturnDataToFrontEndController@callResponseCheck');

Route::post('postCheckDataVarchar', 'ReturnDataToFrontEndController@callVarcharResponseCheck');



Route::get('getColumnType/', 'ReturnDataToFrontEndController@getColumnType');


//Route::get('getColumnType/{columnName}/{tableName}', 'databaseController@getColumnType');

// Route::get('getColumnType/{columnName}/{tableName}', function ($postId, $commentId) {
//     //
// });


/*Route::post('checkData', function () {
    return view('checkData');
});*/

//return view('selectKey')->with('data', $column_names);
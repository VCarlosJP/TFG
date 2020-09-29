<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config; //Config use for global var
use Illuminate\Database\QueryException;
class databaseController extends Controller
{
    public function dataLeftHashTable($table_name){
        $sql = "SELECT A.* FROM " .$table_name.config('global.view_table_standard')." A WHERE NOT A.".config('global.hash_satandard')." IN (SELECT ".config('global.hash_satandard')." FROM ".$table_name.config('global.view_test_table_standard')." )GROUP BY HASH_SAT ";
        
        try {
             $sql_result = DB::select($sql);
        } catch (QueryException $exeption) {
            $exception_info = array(
                "code"=>$exeption->getCode(),
                "message"=>$exeption->getMessage());
            return($exception_info);
        }
        return $sql_result;
    }
    public function dataRightHashTable($table_name){
        $sql = "SELECT A.* FROM " .$table_name.config('global.view_test_table_standard')." A WHERE NOT A.".config('global.hash_satandard')." IN (SELECT ".config('global.hash_satandard')." FROM ".$table_name.config('global.view_table_standard').") GROUP BY HASH_SAT";
       
        try {
             $sql_result = DB::select($sql);
        } catch (QueryException $exeption) {
            $exception_info = array(
                "code"=>$exeption->getCode(),
                "message"=>$exeption->getMessage());
            return($exception_info);
        }
        return $sql_result;
    }
    //Get DataBase for loading the select on MainPage
    public function getDataBaseName(){
        try {
             $sql_result = DB::connection()->getDatabaseName();
        } catch (QueryException $exeption) {
            $exception_info = array(
                "code"=>$exeption->getCode(),
                "message"=>$exeption->getMessage());
            return($exception_info);
        }
        return response()->json($sql_result);
    }
    //Get Tables from selected DataBase
    public function getTablesNameFromSelectedDB(){
        try {
             $sql_result = DB::select('SHOW TABLES');
        } catch (QueryException $exeption) {
            $exception_info = array(
                "code"=>$exeption->getCode(),
                "message"=>$exeption->getMessage());
            return($exception_info);
        }
        $tables_names = [];
        foreach ($sql_result as $table) {
            foreach ($table as $key => $value){
                if(strpos($value, config('global.view_table_standard')) == false && strpos($value, config('global.view_test_table_standard')) == false && strpos($value, config('global.test_table_standard')) == false){
                    array_push($tables_names, $value);
                }
            }
           
        }
        //dd($tables_names);
        return $tables_names;
    }
    public function createView($table_name){
        $view_name = $table_name.config('global.view_table_standard');
        $sql = "CREATE VIEW ". $view_name ." AS SELECT * FROM ". $table_name . ";";
        try {
             DB::statement($sql);
        } catch (QueryException $exeption) {
            $exception_info = array(
                "code"=>$exeption->getCode(),
                "message"=>$exeption->getMessage());
            return($exception_info);
        }
        return true;
    }
    //crea la columna HASH_SAT que se utiliza para algoritmos de comparación internos
    public function createHashColumn($table_name){
        $sql = "ALTER TABLE ".$table_name." ADD ".config('global.hash_satandard')." varchar(128)";
        try {
             DB::statement($sql);
        } catch (QueryException $exeption) {
            $exception_info = array(
                "code"=>$exeption->getCode(),
                "message"=>$exeption->getMessage());
            return($exception_info);
        }
        return true;
    }

    public function createHashCountColumn($table_name){
        $sql = "ALTER TABLE ".$table_name." ADD ".config('global.hash_count_standard')." int(11)";
        try {
             DB::statement($sql);   
        } catch (QueryException $exeption) {
            $exception_info = array(
                "code"=>$exeption->getCode(),
                "message"=>$exeption->getMessage());
            return($exception_info);
        }
        return true;
    }
    public function countHashFromTable($table_name){
        $preSQL = "UPDATE " .$table_name. " SET ".config('global.hash_count_standard')." = 0;";
        DB::unprepared($preSQL);
        $sql = "UPDATE ".$table_name." INNER JOIN (SELECT HASH_SAT, count(HASH_SAT) as repetidos FROM ".$table_name." group by HASH_SAT) t1 ON t1.HASH_SAT = ".$table_name.".HASH_SAT SET ".$table_name.".HASH_SAT_COUNT = t1.repetidos;";
        try {
            DB::unprepared($sql);
        } catch (QueryException $exeption) {
            $exception_info = array(
                "code"=>$exeption->getCode(),
                "message"=>$exeption->getMessage());
            return($exception_info);
        }
        return true; 
    }









    //crea todos los valores HASH para la tabla seleccionada y evita los campos a tratar que se asignen
    public function createHashFromTable($table_name,$fields_to_except_to_hash){
        $preSQL = "UPDATE " .$table_name. " SET ".config('global.hash_satandard')." = NULL;";
        DB::unprepared($preSQL);

        $fields_from_table = $this->getTableColumns($table_name);
        $fields_to_use_from_table = $this->evaluateFieldsToExcept($fields_from_table,$fields_to_except_to_hash);
        $sql = "UPDATE ".$table_name." SET ".config('global.hash_satandard')." =  MD5(concat(";
        foreach($fields_to_use_from_table as $field){
            $sql = $sql.$table_name.".".$field." ,";
        }
        $sql = substr($sql, 0, -1) . "))";
        try {
            DB::unprepared($sql);
        } catch (QueryException $exeption) {
            $exception_info = array(
                "code"=>$exeption->getCode(),
                "message"=>$exeption->getMessage());
            return($exception_info);
        }
        return true;
    }
    //devuelve todas las columnas que contiene una tabla
    public function getTableColumns($table_name)
    {  
        try {
            $sql_result = Schema::getColumnListing($table_name);
        } catch (QueryException $exeption) {
            $exception_info = array(
                "code"=>$exeption->getCode(),
                "message"=>$exeption->getMessage());
            return($exception_info);
        }
        $exeptions = array();
        array_push($exeptions, config('global.hash_satandard'));
        array_push($exeptions, config('global.hash_count_standard'));
        $sql_result = $this->evaluateFieldsToExcept($sql_result,$exeptions);

        return $sql_result;
    }

    public function deleteTable($table_name){
        try {
            DB::unprepared("DROP TABLE IF EXISTS ".$table_name);
        } catch (QueryException $exeption) {
            $exception_info = array(
                "code"=>$exeption->getCode(),
                "message"=>$exeption->getMessage());
            return($exception_info);
        }
        return true;
    }
    public function deleteView($view_name){
        try {
            DB::unprepared("DROP VIEW IF EXISTS ".$view_name);
        } catch (QueryException $exeption) {
            $exception_info = array(
                "code"=>$exeption->getCode(),
                "message"=>$exeption->getMessage());
            return($exception_info);
        }
        return true;
    }
    //trae el tipo de columna
    public function getColumnType($column_name,$table_name){
        $sql = "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='". $table_name ."' AND COLUMN_NAME = '". $column_name ."' ";
        try {
            $sql_result = DB::SELECT($sql);
            $column_type = json_decode(json_encode($sql_result), true);
        } catch (QueryException $exeption) {
            $exception_info = array(
                "code"=>$exeption->getCode(),
                "message"=>$exeption->getMessage());
            return($exception_info);
        }
        return $column_type[0]["COLUMN_TYPE"];
    }
    //funcion que te permite evitar columnas de una tabla para cualquier tipo de operación
    public function evaluateFieldsToExcept($table_columns,$fields_to_except){
        array_push($fields_to_except, config('global.hash_satandard'));
        foreach ($fields_to_except as $table_nameToExcept) {
            if (in_array($table_nameToExcept, $table_columns))
              {
                unset($table_columns[array_search($table_nameToExcept, $table_columns)]);
              }
        }
        return($table_columns);
    }
    public function tableExist($table_name,$delete){
        $sql = "SHOW TABLES LIKE '".$table_name."'";
         try {
            $table_exist_bd = DB::SELECT($sql);
        } catch (QueryException $exeption) {
            $exception_info = array(
                "code"=>$exeption->getCode(),
                "message"=>$exeption->getMessage());
            return($exception_info);
        }
        if($delete == TRUE){  
            foreach ($table_exist_bd as $table_name) {
                $table_name = (array) $table_name;
                $table_name = $table_name[array_keys($table_name)[0]];
                $this->deleteTable($table_name);
            }  
        }else{
            return($table_name);
        }
    }

    public function viewExist($view_name,$delete){
        $sql = "SHOW TABLES LIKE '".$view_name. config('global.view_table_standard') . "'";
         try {
            $view_exist_bd = DB::SELECT($sql);
        } catch (QueryException $exeption) {
            $exception_info = array(
                "code"=>$exeption->getCode(),
                "message"=>$exeption->getMessage());
            return($exception_info);
        }
        if($delete == TRUE){
            foreach ($view_exist_bd as $view_name) {
                $view_name = (array) $view_name;
                $view_name = $view_name[array_keys($view_name)[0]];
                $this->deleteView($view_name);
            }
        }else{
            return($view_name);
        }
    }

     public function runSqlCheck($table_name,$column_name,$conditions_to_check){
        $sql = "SELECT * FROM " . $table_name . " WHERE (";

        foreach ($conditions_to_check as $condition) {
            $sql = $sql . $condition . " AND ";
        } 
        $sql = substr($sql, 0, -5) . ");";
        
        try {
            $sql_result = DB::select($sql);
        } catch (QueryException $exeption) {
            $exception_info = array(
                "code"=>$exeption->getCode(),
                "message"=>$exeption->getMessage());
            return($exception_info);
        }
        //dd($sql);
        return $sql_result;
    }


    public function index()
    {     
        //$this->createHashColumn("convocatorias_test");   //1 PASO
        //$arrayPrueba = array("HASH_SAT");  //2 PASO
        //$this->createHashFromTable("convocatorias",$arrayPrueba); //2 PASO
        //$this->createView("prueba_test"); //3 PASO
        //$this->dataRightHashTable("convocatorias"); //4 PASO
        //$this->dataLeftHashTable("convocatorias");  //4 PASO    
        $this->getTablesNameFromSelectedDB();
        //$this->tableExist("convocatorias",false);
        //$this->viewExist("prueba",TRUE);
    }

    ////////////////////////////////////////////////////////////////////////////
    ////////////////////////////unimplemented///////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    public function rowError(){
       
    }
    ////////////////////////////////////////////////////////////////////////////
    ////////////////////////////unimplemented///////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    public function evaluateFieldNameExceptionToHash($field_name,$field_names_exceptions){
            foreach ($field_names_exceptions as $field_name_exception) {
                if($field_name == $field_name_exception){
                    return false;
                }
            }
            return true;
    }
    ////////////////////////////////////////////////////////////////////////////
    ////////////////////////////unimplemented///////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    //crea el trigger que genera el has automatico para las tablas de datos externos
    public function createTrigger($table_name,$fields_to_except_to_hash){
    $sql = " CREATE TRIGGER Hash_".$table_name." BEFORE INSERT ON ".$table_name." FOR EACH ROW BEGIN SET NEW.HASH_SAT = MD5(concat(";
    $fields_from_table = $this->getTableColumns($table_name);
    $fields_to_use_from_table = $this->evaluateFieldsToExcept($fields_from_table,$fields_to_except_to_hash);
    foreach($fields_to_use_from_table as $field_to_use){
        if($this->evaluateFieldNameExceptionToHash($field_to_use,$fields_to_except_to_hash) == true){
            $sql = $sql."NEW.".$field_to_use.",";
        }
    }
    $sql =substr($sql, 0, -1) . ")); END";
    DB::unprepared($sql);
    }
    ////////////////////////////////////////////////////////////////////////////
    ////////////////////////////unimplemented///////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////
   
    public function compareRowByRow($original_table_name,$testTable,$column_key){
            $original_table_name = $original_table_name."_view";
            $ids=json_decode($this->getValuesForKeyCamp($column_key,$original_table_name),true);
            foreach ($ids as $rowKey) {
                print_r($rowKey[$column_key]);
            }
    }
    ////////////////////////////////////////////////////////////////////////////
    ////////////////////////////unimplemented///////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    public function dataLeftTables($table_name,$table_columns){
       $sql = "SELECT A.* FROM " .$table_name."_view A LEFT JOIN ".$table_name."_test_view B ON (";
        foreach ($table_columns as $column_name) {
            $sql= $sql."A.".$column_name." = B.".$column_name." IS TRUE AND ";
        }
        $sql =substr ($sql, 0, -4) . ") WHERE";
        foreach ($table_columns as $column_name) {
            $sql= $sql." B.".$column_name." IS NULL OR";
        }
        $sql =substr ($sql, 0, -3) . ";";
        $sql_result = DB::select($sql);
        $leftJoinResult = json_decode(json_encode($sql_result), True);
        print_r($sql);
    }
    ////////////////////////////////////////////////////////////////////////////
    ////////////////////////////unimplemented///////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    public function dataRightTables($table_name,$table_columns){

        $sql = "SELECT B.* FROM " .$table_name."_test_view B LEFT JOIN ".$table_name."_view A ON (";
        foreach ($table_columns as $column_name) {
            $sql= $sql."B.".$column_name." = A.".$column_name." IS TRUE AND ";
        }
        $sql =substr ($sql, 0, -4) . ") WHERE";
        foreach ($table_columns as $column_name) {
            $sql= $sql." A.".$column_name." IS NULL OR";
        }
        $sql =substr ($sql, 0, -3) . ";";
        $sql_result = DB::select($sql);
        $leftJoinResult = json_decode(json_encode($sql_result), True);
        print_r($sql);
    }
    ////////////////////////////////////////////////////////////////////////////
    ////////////////////////////unimplemented///////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    public function getSpecificRow($column_to_search,$value,$table_name){//
            $row = DB::table($table_name)->where($column_to_search,$value)->get();
            return $row;
    }
    ////////////////////////////////////////////////////////////////////////////
    ////////////////////////////unimplemented///////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    public function getValuesForKeyCamp($column_to_search,$table_name){
            $column = DB::table($table_name)->select($column_to_search)->get();
            return $column;
    }


    ////////////////////////////////////////////////////////////////////////////
    /////////////////////////////presentacion///////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    public function deleteHashColumn($table_name){
        $sql = "ALTER TABLE ".$table_name." DROP IF EXISTS HASH_SAT ";
        try {
             DB::statement($sql);
        } catch (QueryException $exeption) {
            $exception_info = array(
                "code"=>$exeption->getCode(),
                "message"=>$exeption->getMessage());
            dd($exception_info);
            return($exception_info);
        }
     
    }

    public function deleteHashCountColumn($table_name){
        $sql = "ALTER TABLE ".$table_name." DROP IF EXISTS HASH_SAT_COUNT ";
        try {
             DB::statement($sql);
        } catch (QueryException $exeption) {
            $exception_info = array(
                "code"=>$exeption->getCode(),
                "message"=>$exeption->getMessage());
            dd($exception_info);
            return($exception_info);
        }
     
    }


    ////////////////////////////////////////////////////////////////////////////
    /////////////////////////////unimplemented//////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////

    //crea las tablas de manejo de data externa
    public function createTestTable($table_name,$table_properties){
        $table_name = $table_name. "_test";
        $sql = "CREATE TABLE ". $table_name." ( ";
        $sql_fields = "";
        $table_decode = json_decode($table_properties,true);
            foreach ($table_decode as $field_name => $field_properties) {      
                $sql_fields = $sql_fields ."".$field_name." ".$field_properties."),";
        }
        $sql = $sql . substr ($sql_fields, 0, -1) . ");";
        try {
             DB::statement($sql);
        } catch (QueryException $exeption) {
            $exception_info = array(
                "code"=>$exeption->getCode(),
                "message"=>$exeption->getMessage());
            return($exception_info);
        }
        $this->createHashColumn($table_name);
        return true;
    }

}

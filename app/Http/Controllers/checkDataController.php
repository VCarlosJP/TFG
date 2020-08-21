<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class checkDataController extends Controller
{
    public function checkIntMultiOperator($table_name,$column_name,$vals_to_operate,$operators){
    	$table_name = $table_name . config('global.view_table_standard');
    	$conditions_to_check = array();
    	if(count($vals_to_operate)==count($operators)){
    		for ($i=0; $i < count($vals_to_operate) ; $i++) { 
    			array_push($conditions_to_check,$this->checkWhereInt($table_name,$column_name,$vals_to_operate[$i],$operators[$i]));
    		}
    	}
    	//dd($conditions_to_check);
    	$sql_result = app('App\Http\Controllers\databaseController')->runSqlCheck($table_name,$column_name,$conditions_to_check);
    	return $sql_result;
    }

    public function checkWhereInt($table_name,$column_name,$val_to_operate,$operator){
    	//dd($val_to_compare);
    	$where = $table_name .".". $column_name ." ". $operator ." ". $val_to_operate;
    	return $where;
    }

    public function checkVarcharMultiOperator($table_name,$column_name,$vals_to_operate,$operations,$capital_senstive){
        $table_name = $table_name . config('global.view_table_standard');
        $conditions_to_check = array();
        if(count($vals_to_operate)==count($operations) &&  count($vals_to_operate)==count($capital_senstive)){
            for ($i=0; $i < count($vals_to_operate) ; $i++) { 
                array_push($conditions_to_check,$this->checkWhereVarchar($table_name,$column_name,$vals_to_operate[$i],$operations[$i],$capital_senstive[$i]));
            }
        }
        //dd($conditions_to_check);
        $sql_result = app('App\Http\Controllers\databaseController')->runSqlCheck($table_name,$column_name,$conditions_to_check);
/////////////////////////////////////////////////
        return $sql_result;        
////////////////////////////////////////////////        
    }

    public function checkWhereVarchar($table_name,$column_name,$val_to_operate,$operation,$capital_senstive){   
        $where = "";
        if($capital_senstive==1){
            $where = "BINARY "; 
        }
        switch ($operation) {
            case "0":
                //Equal "text"
                $where = $where . $table_name . "." . $column_name . " like " . "'" . $val_to_operate ."'";
                return $where;
                break;
            case "1":
                //Diferent "text"
                $where = $where . $table_name . "." . $column_name . " not like " . "'" . $val_to_operate ."'";
                return $where;
                break;
            case "2":
                //Include "text"
                $where = $where . $table_name . "." . $column_name . " like " . "'%" . $val_to_operate ."%'";
                return $where;
                break;
            case "3":
                //Not include "text"
                $where = $where . $table_name . "." . $column_name . " not like " . "'%" . $val_to_operate ."%'";
                return $where;
                break;                 
            case "4":
                //Check only "text"
                //val to operate is the range number to check normaly [0-9]
                $where = $where . $table_name . "." . $column_name . " not like " . "'%" . $val_to_operate ."%'";
                return $where;
                break;
            case ">" || "<" || "=" || "<>":
                //Size of "text" 
                $where = $where . "LENGTH( " . $table_name . "." . $column_name ." ) ". $operation . " ". $val_to_operate;
                return $where;
                break;
        }
    }

    // public function getRulesForField($fieldtype){

    //     $rules = array();

    //     switch ($fieldtype) {
    //         case 'int':
    //             $rules = config('global.int_rules');
    //             break;
            
    //         default 'varchar':
    //             $rules = config('global.varchar_rules');
    //             # code...
    //             break;
    //     }
    //     return $rules;
    // }
    public function index()
    {     
    }
}

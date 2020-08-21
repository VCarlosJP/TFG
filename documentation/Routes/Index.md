# Rutas

Contenidos:

 -  [getDB](#getDB) 
 -  [getTablesName](#getTablesName) 
 -  [assembleDatabase](#assembleDatabase) 
 -  [setDataToCompare](#setDataToCompare) 
 -  [selectKey](#selectKey) 
 -  [callHashComparators](#callHashComparators) 
 -  [resetPresentacionBD](#resetPresentacionBD) 





### getDB

#### <u>get</u>

Esta ruta ejecuta la función **getDataBaseName** del controlador  [DatabaseController](..\Controllers\DatabaseController.md)

#### <u>Respuesta</u>

 **$sqlResult** (Retorna el nombre de la base de datos) 

```php
'Database'
```





### getTablesName

#### <u>get</u>

Esta ruta ejecuta la función **getTablesNameFromSelectedDB** del controlador  [DatabaseController](..\Controllers\DatabaseController.md)

#### <u>Respuesta</u>

**$sqlResult** (Array de objetos que contiene el nombre de cada una de las tablas)

```php
Array
(
    [0] => 'tabla1'
    [1] => 'tabla2'
    [2] => 'tabla3'
    [3] => 'tabla4'
)
```





### assembleDatabase

#### <u>post</u>

Esta ruta ejecuta la función **createHashColumnsFromSelectedTables** del controlador  [AssembleDatabaseController](..\Controllers\AssembleDatabaseController.md)





### setDataToCompare

#### <u>post</u>

Esta ruta ejecuta la función **createHashInSelectedTables** del controlador  [AssembleDatabaseController](..\Controllers\AssembleDatabaseController.md)





### resetPresentacionBD

#### <u>post</u>

Esta ruta ejecuta la función **cleanDatabaseController** del controlador  [AssembleDatabaseController](..\Controllers\AssembleDatabaseController.md)





### callHashComparators

#### <u>post</u>

Esta ruta ejecuta la función **callHashComparators** del controlador  [AssembleDatabaseController](..\Controllers\AssembleDatabaseController.md)


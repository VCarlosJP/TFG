# DatabaseController

 Controlador que hace la función del backend y realiza todas las comunicaciones con el servidor de BD, este controlador es el que realiza las verificaciones de información que se basan completamente en una **Diferencia simétrica de conjuntos** que contendrá toda la información que no es común entre ellos, toda esta verificación la realiza con un cálculo parecido al Left o Right Join de Sql, pero se tomaron algunas medidas para optimizar el tiempo de respuesta hasta tener pruebas que sobre 50,000 datos en ambas tablas la respuesta toma menos de un segundo en ejecutarse en el motor. 

**HASH_SAT** es la medida principal sobre la cual se trabaja ahora la comparación para evitar producto cartesiano tan grande entre todos los campos de ambas tablas (esto es lo que realiza actualmente un Left o Right Join con las tablas).

![](..\img\DiferenciaSimetricaDataBaseControllerIMG.svg)

El **HASH_SAT** consiste en crear un identificador único para cada tupla según todos los valores de sus campos en las tablas para realizar las comparaciones entre los **HASH_SAT** y no entre todos los campos, así se reduce mucho el tiempo de ejecución de las consultas y se hizo una modificación para las consultas Left y Right Join, que nos otorga el mismo resultado pero sin utilizar el producto cartesiano que estas generan y simplemente aprovechando las capacidades del motor para la búsqueda de campos que existan o no en otras tablas (“WHERE NOT”).



## Funciones

 - [dataLeftHashTable](#dataLeftHashTable() & dataRightHashTable())
 - [dataRightHashTable](#dataLeftHashTable() & dataRightHashTable())
 - [getDataBaseName](#getDataBaseName)
 - [getTablesNameFromSelectedDB](#getTablesNameFromSelectedDB)
 - [createView](#createView)
 - [createHashColumn](#createHashColumn)
 - [createHashFromTable](#createHashFromTable)
 - [getTableColumns]()
 - [deleteTable]()
 - [deleteView]()
 - [getColumnType]()
 - [evaluateFieldsToExcept]()
 - [tableExist]()
 - [viewExist]()





### dataLeftHashTable() & dataRightHashTable()

Estas funciones son las principales para ejecutar la diferencia de conjuntos, realizan el mismo tipo de acción y es buscar los **HASH_SAT** que existan en una tabla y no en la otra, nos devuelve un **array** con los objetos únicos de cada tabla, esto nos permite reconocer qué objetos son los que generan incongruencias y de que lado tenemos las variaciones, pudiendo deducir si es un error de nuestra base de datos local (base de datos de desarrollo interno) o si es con nuestro universos de datos del que nos alimentamos (base de datos externa). 

#### <u>Parámetros de entrada:</u>

**$tableName** (String que es directamente el nombre de la tabla que deseamos tratar)

```php
$tableName = "convocatorias";
```
#### <u>Parámetros de salida o respuesta:</u>

**$sqlResult** (Array de objetos que contiene cada uno de estos que sea una discrepancia)

```php
Array
(
    [0] => stdClass Object
        (
            [login_est] => efrain.salazar
            [codigo_asign] => 
            [matriculaSIIU] => 1
            [primeraMatricula] => 0
            [segundaMatricula] => 0
            [terceraMatricula] => 1
            [HASH_SAT] => 862b3acd76db74f75509fe5301339c52
        )
    [1] => stdClass Object
        (
            [login_est] => efrain.salazar
            [codigo_asign] => 
            [matriculaSIIU] => 1
            [primeraMatricula] => 0
            [segundaMatricula] => 1
            [terceraMatricula] => 1
            [HASH_SAT] => 452b3acd76db74f75509fe5301339c93

        )
)
```





### getDataBaseName()

Función básica para devolver el nombre de la base de datos en la que se está trabajando. 

#### <u>Parametros de entrada:</u>

**La función no necesita parámetros de entrada**

#### <u>Parametros de salida</u>

 **$sqlResult** (Retorna el nombre de la base de datos) 

```php
'Database'
```





### getTablesNameFromSelectedDB()

Retorna todas las tablas dentro de la base de datos que se pase como parámetro de entrada.

#### <u>Parametros de entrada:</u>

**La función no necesita parámetros de entrada**

#### <u>Parametros de salida:</u>

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





### createView()

Una de las funciones principales que se utiliza para la creación de las vistas para realizar todas las comparaciones de forma segura o evitar un poco el tema de inyecciones SQL (aunque no está completamente contemplado).

#### <u>Parametros de entrada:</u>

**$table_Name** (String que es directamente el nombre de la tabla para crear su vista) 

```php
$tableName = "tabla";
```

#### <u>Parametros de salida</u>

**Esta función no cuenta con variable de salida si este nos devuelve un true cuando la acción se ha realizado de manera correcta.**

```php
true
```





### createHashColumn()

Esta función crea la columna HASH_SAT en la tabla que se desee, para luego ser utilizado en comparaciones internas. 

#### <u>Parametros de entrada:</u>

**$table_Name** (String que es directamente el nombre de la tabla para crear su vista) 

```php
$tableName = "tabla";
```

#### <u>Parametros de salida</u>

**Esta función no cuenta con variable de salida si este nos devuelve un true cuando la acción se ha realizado de manera correcta.**

```php
true
```





### createHashFromTable()

Esta función crea el valor de HASH_SAT para la tabla que se desee y además acepta como parametro una lista de campos que no se deseen utilizar para la comparación, ya que estos son seleccionables por el usuario. 

#### <u>Parametros de entrada:</u>

**$table_Name** (String que es directamente el nombre de la tabla para crear su vista) 

```php
$tableName = "tabla";
```

**$fields_to_except_to_hash** (array de strings que contiene los campos que no se quieran utilizar para las comparaciones) 

```php
Array
(
    [0] => 'campo1'
    [1] => 'campo2'
    [2] => 'campo3'
    [3] => 'campo4'
)
```

#### <u>Parametros de salida</u>

**Esta función no cuenta con variable de salida si este nos devuelve un true cuando la acción se ha realizado de manera correcta.**

```php
true
```







### getTableColumns()

Función basica para solicitar las columnas de la tabla que se desee.

#### <u>Parametros de entrada:</u>

**$table_Name** (String que es directamente el nombre de la tabla para crear su vista) 

```php
$tableName = "tabla";
```

#### <u>Parametros de salida</u>

**Esta función no cuenta con variable de salida si este nos devuelve un true cuando la acción se ha realizado de manera correcta.**

```php
true
```





### deleteTable()

Función basica para eliminar de la base de datos la tabla si esque esta existe.

#### <u>Parametros de entrada:</u>

**$table_Name** (String que es directamente el nombre de la tabla para crear su vista) 

```php
$tableName = "tabla";
```

#### <u>Parametros de salida</u>

**Esta función no cuenta con variable de salida si este nos devuelve un true cuando la acción se ha realizado de manera correcta.**

```php
true
```





### deleteView()

Función basica para eliminar de la base de datos la vista si esque esta existe.

#### <u>Parametros de entrada:</u>

**$view_Name** (String que es directamente el nombre de la tabla para crear su vista) 

```php
$viewName = "tabla";
```

#### <u>Parametros de salida</u>

**Esta función no cuenta con variable de salida si este nos devuelve un true cuando la acción se ha realizado de manera correcta.**

```php
true
```





### getColumnType()

Función para devolver el tipo de campo en la tabla que nosotros deseemos.

#### <u>Parametros de entrada:</u>

**$column_name** (String que es directamente el nombre del campo del cual solicitamos su tipo)

```php
$columnName = "campo1";
```

**$table_name** (String que es directamente el nombre de la tabla)

```php
$tableName = "tabla";
```

#### <u>Parametros de salida</u>

**$column_name** (String que es directamente el tipo de valor del campo)

```php
$columnType = "int(8)";
```





### evaluateFieldsToExcept()

Esta función nos permite eliminar los campos no deseados para generar el HASH_SAT de cada objeto.

#### <u>Parametros de entrada:</u>

**$table_columns** (array que incluye todos los campos de la columna a tratar)

```php
$tableColumns = Array
(
    [0] => HASH_SAT
    [1] => campo1
    [2] => campo2
    [3] => campo3
    [4] => campo4
    [5] => campo5
)
```

**$fields_to_except** (array de los campos que se desea evitar en la tabla)

```php
$fieldsToExcept = Array
(
    [0] => HASH_SAT
    [1] => campo1
    [2] => campo2
)
```

#### <u>Parametros de salida</u>

**$table_columns** (array que devuelve los campos de la tabla que si se desean utilizar)

```php
$tableColumns = Array
(
    [3] => campo3
    [4] => campo4
    [5] => campo5
)
```







### tableExist()

Esta función nos permite verificar la existencia de la tabla pasada como parametro.

#### <u>Parametros de entrada:</u>

**$table_name** (String que es directamente el nombre de la tabla)

```php
$tableName = "tabla";
```

#### <u>Parametros de salida</u>

**$table_name** (objeto que contiene la tabla que se desea buscar en la base de datos)

```php
$tableColumns = stdClass Object
(
    [Tables_in_database (tabla)] => tabla
)
```





### viewExist()

Esta función nos permite verificar la existencia de la vista de la tabla que pasemos como parametro.

#### <u>Parametros de entrada:</u>

**$table_name** (String que es directamente el nombre de la tabla)

```php
$tableName = "tabla";
```

#### <u>Parametros de salida</u>

**$view_name** (objeto que contiene la vista que se desea buscar en la base de datos)

```php
stdClass Object
(
    [Tables_in_prueba (tabla_view)] => tabla_view
)
```



### runSqlCheck()

Esta función permite la ejecición de sql para las verificaciones de reglas del campo asignado.

#### <u>Parametros de entrada:</u>

**$table_name** (String que es directamente el nombre de la tabla)

```php
$table_name = "tabla";
```

**$column_name** (String que es directamente el nombre de la columna a evaluar)

```php
$table_name = "tabla";
```

**$conditions_to_check** (Es un array de las condiciones que se desean verificar en el campo)

```php
$table_name = Array
(
    [0] => BINARY table1_view.grado like '%Ingenieria Informatica%'
    [1] => LENGTH( table1_view.grado ) > 5
    [2] => table1_view.grado not like '%[0-9]%'
)
```



#### <u>Parametros de salida:</u>

**$sqlResult** (Array que contiene cada objeto que se encuentre en las reglas o verificaciones asignadas)

```php
Array
(
    [0]{	
        [grado] => "Ingenieria Informatica"
    	[HASH_SAT] => "345faecce8295f38dd6053df21ecb5e5"        
    }
    [1]{	
        [grado] => "Ingenieria Informatica"
    	[HASH_SAT] => "3cb1d8bd06246b9863778088a0db6aac"        
    }
)
```






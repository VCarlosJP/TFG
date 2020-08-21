# AssembleDatabaseController

Este archivo contiene todos los controladores necesarios para preparar la data que se desea comparar, nutriéndose de las utilidades de **DataBaseController**.



## Funciones

- [createHashColumnsFromSelectedTables](#createHashColumnsFromSelectedTables)
- [createViewsFromSelectedTables](#createViewsFromSelectedTables)
- [createHashInSelectedTables](#createHashInSelectedTables)
- [cleanDatabaseController](#cleanDatabaseController)

###  createHashColumnsFromSelectedTables()

Este controlador es llamado en la primera vista, justo después que el usuario ha decidido con que tablas trabajar y antes de pasar a la segunda vista de la aplicación.

Se encarga de pasar todos los nombres de las tablas que el usuario selecciono en el interfaz y las tablas _test correspondientes, a la función **createHashColumn()**.

### <u>Parámetros de entrada:</u>

**$request** contiene un JSON con el nombre de todas las tablas seleccionadas; Posteriormente se extrae la data a un array para facilitar el trabajo.

```php
$request->input('Data') // ["tabla1", "tabla2"]
```

### <u>Parámetros de salida o respuesta:</u>

Se devuelve la función **createViewsFromSelectedTables()**





###  createViewsFromSelectedTables()

El controlador es ejecutado en consecuencia de **createHashColumnsFromSelectedTables()**.

Pasa el nombre de todas las tablas seleccionadas originalmente y sus respectivas tablas _test a la función **createView()** 

### <u>Parámetros de entrada:</u>

**$tables** contiene un array con el nombre de todas las tablas seleccionadas originalmente.

```php
$tables; //["tabla1", "tabla2" ]
```

### <u>Parámetros de salida o respuesta:</u>

Se devuelve la función **getColumnsFromSelectedTables()**.





###  createHashInSelectedTables()

Este controlador es ejecutado cuando el usuario finaliza el trabajo en la segunda vista y presiona el botón **Next Page**. 

### <u>Parámetros de entrada:</u>

**$request** contiene un JSON con todas las tablas que fueron seleccionadas en la primera vista y dentro de cada una de ellas, las columnas que el usuario ha decidido ignorar.

```php
$request->input('Data') // {"tabla1":["columna1", "columna9"], "tabla2": []}
```

### <u>Parámetros de salida o respuesta:</u>

Retorna la vista **comparison** junto con una variable que almacena el nombre de todas las tablas seleccionadas anteriormente.





###  cleanDatabaseController()

Esta función obtiene todos los nombres de las tablas contenidas en la base de datos con la finalidad de hacer una limpieza del trabajo realizado con el SAT; El1iminando las columnas hash y las vistas.  

### <u>Parámetros de entrada:</u>

**La función no necesita parámetros de entrada.**

### <u>Parámetros de salida o respuesta:</u>

Retorna a la ruta **/**
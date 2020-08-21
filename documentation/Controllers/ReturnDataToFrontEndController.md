# ReturnDataToFrontEndController

Esta controlador se encarga de retornar data al html de nuestra aplicación.

## Funciones

- [getColumnsFromSelectedTables](#getColumnsFromSelectedTables)





### getColumnsFromSelectedTables()

Función que se ejecuta para poder obtener el nombre de las columnas de cada una de las tablas que el usuario selecciono en la vista inicial.

### <u>Parámetros de entrada:</u>

**$tables** (variable que contiene un array de los nombres de las tablas seleccionadas.).

```php
$tables = ["tabla1", "tabla2"];
```

### <u>Parámetros de salida o respuesta:</u>

retorna la vista **selectKey** junto con una variable que contiene las mismas tablas y dentro de cada una de estas los nombres de sus columnas.

```php
$column_names = [
    "tabla1":["columna1", "columna2", "columna3" ... ],
    "tabla2":["columna1", "columna2", "columna3" ... ]
]
```


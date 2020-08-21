# compareDataController

Controlador encargado de manejar la llamada a una comporación y su respuesta.

## Funciones

- [callHashComparators](#callHashComparators)

### callHashComparators()

Función que se ejecuta para poder obtener las filas que se encuentra en la tabla local pero no en la tabla externa y viceversa.

### <u>Parámetros de entrada:</u>

**$request** (contiene el nombre de la tabla que se ha seleccionado para realizarle una comparación entre su tabla _test correspondiente).

```javascript
$request->input('Data') // "tabla1"
```

### <u>Parámetros de salida o respuesta:</u>

Retorna dos objetos (local-table y external-table) que contiene las filas cuyo campo difiere con su fila correspondiente en la tabla contraria.

```php
 [
    "local-table": {
    	{id: 4, column1: "name", column2: "lastname" ... },
        {id: 9, column1: "name", column2: "lastname" ... },
        {id: 27, column1: "name", column2: "lastname" ... },
    },
    "external-table": {
    	{id: 4, column1: "lastname", column2: "name" ... },
        {id: 9, column1: "lastname", column2: "name" ... },
        {id: 27, column1: "lastname", column2: "name" ... },
    }
];
```


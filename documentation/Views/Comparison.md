# comparison View

La tercera y ultima vista del sistema SAT. En las vistas anteriores, se prepararon las tablas de la base de datos para finalmente realizar las comparaciones con ayuda de esta vista.

Mediante un select, se listan todas las tablas con las cuales escogimos trabajar desde un principio. Se nos permite seleccionar una a la vez para posteriormente iniciar el proceso de comparación con las tablas externas.

Una vez se realiza la comparación, se renderiza la respuesta en dos contenedores que representan la data local y la data externa. Existen dos tipos de respuesta:

- **En caso de que no se encuentre ninguna diferencia**: se renderiza en ambos contenedores el mensaje "Everything Fine".
- **En caso de que se encuentren diferencias**: Se renderizan todas las filas de la tabla seleccionada que solo se han encontrado en local, en el contenedor de la izquierda y en el de la derecha todas las tablas encontradas en la data externa que no existe en la  data local.


## Funciones

- [callComparison](#callComparison)
- [changeElementStatus](#changeElementStatus)
- [callHashComparators](#callHashComparators)
- [renderResponseData](#renderResponseData)
- [generateResponseTable](#generateResponseTable)



### callComparison()

Se utiliza para mandar a llamar las funciones **changeElementsStatus()** y **callHashComparators()** y guarda en una variable el nombre de la tabla seleccionada a la cual se le quiere realizar la comparación.

### <u>Parámetros de entrada:</u>

**La función no necesita parámetros de entrada**

### <u>Parámetros de salida o respuesta:</u>

La llamada de las dos funciones mencionadas anteriormente.





### changeElementsStatus()

La función se manda a llamar dos veces por cada llamada a **callComparison()**. Se encarga de bloquear los elementos necesarios para realizar una comparación y colocarles un estado de loading... mientras se esta esperando la respuesta de **callHashComparators()**. Esto con la intención de que un usuario no mete una gran carga al servidor pidiendo múltiples comparaciones. Cuando se obtiene respuesta, la función se ejecuta de nuevo liberando los elementos, para poder realizar una nueva comparación si se desea.

### <u>Parámetros de entrada:</u>

**bool** La función bloquea o desbloquea los elementos en base a si el parámetro pasado es true o false.

### <u>Parámetros de salida o respuesta:</u>

Bloqueo o desbloqueo de elementos necesarios para realizar comparación.





### callHashComparators()

La función manda a llamar la ruta **/callHashComparators**, para así poder obtener como respuesta las diferencias encontradas entre ambas tablas.

### <u>Parámetros de entrada:</u>

**table_to_work_with** que es la variable que contiene el nombre de la tabla que se ha seleccionado por el usuario.

```javascript
table_to_work_with = 'tabla1';
```

### <u>Parámetros de salida o respuesta:</u>

En caso de que la request sea exitosa se ejecutan las funciones **changeElementsStatus()** y **renderResponseData()**.





### renderResponseData()

La función inicia limpiando los contenedores, esto para quitar los resultados anteriores de cada test. Posteriormente se revisa la longitud de la respuesta obtenida, en caso de estar vacío se hace un append del mensaje **Everything Fine**, caso contrario se manda a llamar la función **generateResponseTable()**.

### <u>Parámetros de entrada:</u>

**tables_differences** es un objetoque contiene todas las diferencias encontradas en la tabla con la que se hizo el request.

```javascript
tables_differences = {
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
 };
```

### <u>Parámetros de salida o respuesta:</u>

Un append de un mensaje de que todo esta bien o una llamada a la función **generateResponseTable()**.





### generateResponseTable()

Función que se encarga de generar una tabla dinámicamente con todas las filas que contienen algún campo que no coincidió con la tabla contraria, para después insertarla en el contenedor correspondiente. Esta función se realiza una vez por lado.

### <u>Parámetros de entrada:</u>

**tables_differences** es un objeto que contiene todas las diferencias encontradas en la tabla con la que se hizo el request.

```javascript
tables_differences = {
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
 };
```

**table_side** es una variable que ayuda a identificar a cual de los dos objetos de **tables_differences** queremos acceder.

### <u>Parámetros de salida o respuesta:</u>

Se obtiene como respuesta dos append de la tabla creada, uno representa la tabla local y el otro representa la tabla externa.




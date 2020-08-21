# MainPage View

Esta es la vista de donde parte toda la aplicación. Ya que se encarga de la selección de las tablas locales que se desean revisar, para posteriormente realizar las respectivas verificaciones con sus tablas externas equivalentes. 

## Funciones

- [callForTables](#callForTables)
- [pushToResumeTable](#pushToResumeTable)
- [insertIntoResumeTable](#insertIntoResumeTable)
- [nextPageButtonStatus](#nextPageButtonStatus)
- [postSelectedTables](#postSelectedTables)

### callForTables()

Función que manda a llamar una ruta que devuelve el nombre de todas las tablas contenidas dentro de la base de datos. En caso de obtener una respuesta, se realiza una iteración para poder insertar los nombres uno a uno en la vista. Para que posteriormente un usuario se capaz de seleccionarlas.

### <u>Parámetros de entrada:</u>

**La función no necesita parámetros de entrada**

### <u>Parámetros de salida o respuesta:</u>

La función no retorna una respuesta, únicamente hace el append de cada uno de los nombres de las tablas en el HTML.





### pushToResumeTable()

Cuando un usuario selecciona una tabla de la lista, esta se marca con la clase 'active' de Bootstrap, se introduce el nombre de la tabla en un array que contendrá la selección final del usuario y también se lista dentro del HTML para que el usuario se asegure de cuales son las tablas que están marcadas.

### <u>Parámetros de entrada:</u>

**selected_table_id** (String que recibe el id de la tabla seleccionada, el cual es equivalente al nombre de la tabla)

```javascript
selected_table_id = "convocatorias";
```

### <u>Parámetros de salida o respuesta:</u>

Se manda a llamar la función **insertIntoResumeTable()**  





### insertIntoResumeTable()

Cuando la función es llamada, se itera una lista que contiene el nombre de todas las tablas que han sido marcadas por el usuario para después renderizarlas en la vista.

### <u>Parámetros de entrada:</u>

**La función no necesita parámetros de entrada, se itera sobre una variable global.**

### <u>Parámetros de salida o respuesta:</u>

Se manda a llamar la función **nextPageButtonStatus()**  





### nextPageButtonStatus()

La función revisa si el usuario tiene tablas seleccionadas. En caso de que no, no se le permite ir a la siguiente; Caso contrario,  se le permite.

### <u>Parámetros de entrada:</u>

**La función no necesita parámetros de entrada, se trabaja sobre una variable global.**

### <u>Parámetros de salida o respuesta:</u>

**El botón Next Page se bloquea o se desbloquea**  





### postSelectedTables()

Cuando el usuario ya ha decidido que tablas usar para la verificación posterior, esta función manda a llamar la ruta **/assembleDatabase**.

### <u>Parámetros de entrada:</u>

**La función no necesita parámetros de entrada, se trabaja sobre una variable global.**

### <u>Parámetros de salida o respuesta:</u>

**data = {db, tables};** (variable que contiene el nombre de la base de datos y todas las tablas que se seleccionaron al final. Se convierte a un JSON para realizar el submit a la ruta mencionada anteriormente) 

```json
data = 	{
    	"db":"db1",
		"tables":["convocatorias1","convocatorias1"]
        };
```


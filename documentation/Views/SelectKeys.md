# SelectKey View

La segunda vista de la aplicación, es en donde decimos que columnas se tienen que tomar en cuenta en cada tabla para poder realizar el hash de cada una de sus filas.

Al cargar la vista en el cliente, se listan todas las tablas que el usuario selecciono en la vista MainPage.  Cuando el usuario selecciona una de estas tablas, a su lado derecho se cargan todos los nombres de las columnas que están contenidas en dicha tabla. Por defecto, todas aparecen como marcadas con un checkbox, indicando que si se quieren tomar en cuenta para el hash. 



## Funciones

- [displayColumnsFromClickedTable](#displayColumnsFromClickedTable)
- [addColumns](#addColumns)
- [postSelectedColumns](#postSelectedColumns)



### displayColumnsFromClickedTable()

Función que se encarga de renderizar los nombres de las columnas junto con un checkbox cuando un usuario selecciona una tabla. 

### <u>Parámetros de entrada:</u>

**clicked_table_name** (variable que contiene el nombre de la tabla que el usuario ha seleccionado).

```javascript
clicked_table_name = "convocatorias1";
```

### <u>Parámetros de salida o respuesta:</u>

Realize el append de todas las columnas de la tabla correspondiente.





### addColumns()

Cuando un usuario selecciona una columna chequeada, esta se desmarca y se introduce a la variable global **columns_to_ignore[]**.

### <u>Parámetros de entrada:</u>

**La función no necesita parámetros de entrada, el nombre se obtiene mediante el this.id (el cual contiene el nombre de la tabla) cuando se hace click en una tabla.**

### <u>Parámetros de salida o respuesta:</u>

La función no retorna una respuesta, únicamente hace el append de cada uno de los nombres de las tablas en el HTML.





### postSelectedColumns()

Realiza un post a la ruta **/setDataToCompare** con **columns_to_ignore ** como data. Para así poder hacer los hash de las filas en cada tabla despreciando las columnas contenidas en dicho objeto.

### <u>Parámetros de entrada:</u>

**La función no necesita parámetros de entrada, se trabaja con la variable global columns_to_ignore**

### <u>Parámetros de salida o respuesta:</u>

Se realiza un submit a la ruta menciona anteriormente con un JSON String de **columns_to_ignore** como data. 

```javascript
columns_to_ignore = {"tabla1":["columna3","columna6"],
                     "tabla2":[]
                    }
```


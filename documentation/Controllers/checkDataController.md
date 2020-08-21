# checkDataController

Controlador encargado de revisar el cumplimiento de reglas que se asignen a un campo.

## Funciones

- [checkIntMultiOperator](#checkIntMultiOperator)

- [checkWhereInt](#checkWhereInt)

- [checkVarcharOperator](#checkVarcharOperator)

- [checkWhereVarchar](#checkWhereVarchar)

  

### checkIntMultiOperator()

Permite la concatenacion de todas las reglas que se deseen acoplar a un campo de tipo Int en base de datos.

### <u>Parámetros de entrada:</u>

**$table_name** (contiene el nombre de la tabla que se ha seleccionado para realizar la asignación de reglas a los campos).

```php
$table_name = "tabla1"
```

**$column_name** (contiene el nombre de la columna de tipo int para trabajar).

```php
$column_name = "column1"
```

**$vals_to_operate** (Este es un array de valores con los que se trabajaran las distintas operaciones asignadas, cada uno de estos valores corresponde directamente a una operacion que estara en la variable **$operators**).

```php
Array
(
    [0]{"5"}
    [1]{"0"}
)
```

**$operators** (Array que contiene las operaciones que estan relacionadas a los valores para realizar la operacion deseada).

```php
Array
(
    [0]{"<"}
    [1]{">"}
)
```

### <u>Parámetros de salida o respuesta:</u>

Retorna un array con todas las reglas que se desean aplicar al campo dentro de la tabla seleccionada que seran utilizados.

```php
array: [
  0 => "tabla1_view.column1 < 5"
  1 => "tabla1_view.column1 > 0"
]
```





### checkWhereInt()

Tiene un funcionamiento interno para generar los trozos de sql dentro de la funcion principal que es **checkIntMultiOperator**.

### <u>Parámetros de entrada:</u>

**$table_name** (contiene el nombre de la tabla que se ha seleccionado para realizar la asignación de reglas a los campos).

```php
$table_name = "tabla1"
```

**$column_name** (contiene el nombre de la columna de tipo int para trabajar).

```php
$column_name = "column1"
```

**$val_to_operate** (Este es el  valor que se desea trabajar en la operacion asignada que estara en la variable **$operator**).

```php
$val_to_operate = "5"
```

**$operator (Contiene la operacion que esta relacionada al valor para realizar la operacion deseada).

```php
$operator = ">"
```

### <u>Parámetros de salida o respuesta:</u>

Retorna un string con la condicion o regla ya concatenada para formar parte de la sql a ejecutar.

```php
"tabla1_view.column1 > 5"
```





### checkVarcharOperator()

Permite la concatenacion de todas las reglas que se deseen acoplar a un campo de tipo Varchar en base de datos.

### <u>Parámetros de entrada:</u>

**$table_name** (contiene el nombre de la tabla que se ha seleccionado para realizar la asignación de reglas a los campos).

```php
$table_name = "tabla1"
```

**$column_name** (contiene el nombre de la columna de tipo int para trabajar).

```php
$column_name = "column1"
```

**$vals_to_operate** (Este es un array de valores con los que se trabajaran las distintas operaciones asignadas, cada uno de estos valores corresponde directamente a una operacion que estara en la variable **$operators**).

```php
Array
(
    [0]{"Ingenieria Informatica"}
    [1]{"5"}	
    [2]{"[0-9]"}
)
```

**$operators** (Array que contiene las operaciones que estan relacionadas a los valores para realizar la operacion deseada).

En este caso las operaciones estan trabjadas con un switch para que sea más facil el tratamiento desde el front, a continuación se dejan plasmadas las equivalencias de cada caso del switch para las operaciones.

```php
 case "0":							=>Equal 
 case "1":							=>Diferent
 case "2":							=>Include
 case "3":							=>Not Include
 case "4":							=>Only text
 case ">" || "<" || "=" || "<>":	=>Length 
```

Luego observamos la forma en que la variable de entrada debe estar estructurada

```php
Array
(
    [0]{"2"}
    [1]{">"}
    [1]{"4"}
)
```

**$capital_senstive** (Array que contiene la instruccion para que cada una de las operaciones anteriores se trabajen de manera estricta en base a la diferencia de mayusculas y minusculas o si es indiferente).

```php
Array
(
    [0]{"1"}
    [1]{"0"}
    [2]{"0"}
)
```





### <u>Parámetros de salida o respuesta:</u>

Retorna un array con todas las reglas que se desean aplicar al campo dentro de la tabla seleccionada que seran utilizados.

```php
array: [
  0 => "tabla1_view.column1 < 5"
  1 => "tabla1_view.column1 > 0"
]
```


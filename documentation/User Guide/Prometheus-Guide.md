# Manual de Usuario - Prometheus

El sistema de alerta temprana es un software desarrollado con la finalidad de mantener la integridad y salud de los datos, el proyecto actualmente funciona sobre un proyecto Laravel fácilmente adaptable a cualquier base de datos en MySql sobre la que se desee trabajar.

## Preparación del Sistema

1. Una vez clonado el proyecto es necesario dirigirse al archivo /.env y cambiar los siguientes campos adaptándose a la base de datos con la cual se quiere trabajar.

   ```php
   DB_DATABASE=database_name
   DB_USERNAME=root
   DB_PASSWORD=
   ```

2. Antes de correr la aplicación con el comando `php artisan serve` es necesario ejecutar el comando `composer install` para poder instalar todas las dependencias del proyecto.

3. Posteriormente, dentro de esa misma base de datos es necesario tener las tablas externas que nos interesan comparar (duplicadas en caso de no tener data externa), con el sufijo `_test` para que el sistema reconozca que se trata de las tablas externas.

   ```php
   //Ejemplo tabla local
   Personas
   //Ejemplo tabla externa
   Personas_test
   ```

   

## Pagina de Inicio

1. Al carga la aplicación en nuestro navegador web iniciaremos con una vista con un select, en el que tenemos que marcar la base a datos con la cual vamos a trabajar. Una vez hecho esto, tendremos una lista a la derecha para poder seleccionar todas las tablas que nos interesan analizar. Ademas, en caso de ser muchas tablas contamos con una pequeña ventana que resume nuestra selección.

2. Una vez marcada por lo menos una tabla de la base de datos, podemos pasar a la siguiente vista, la cual nos brinda dos modos diferentes de trabajo.

   1. **Check Data Status**

      Este modo nos permite realizar comprobaciones en nuestra data, por medio de un conjunto de reglas que se pueden aplicar dependiendo del tipo de dato.

   2. **Compare Data**

      Es el modulo principal de la aplicación y nos permite revisar la integridad de los datos de una tabla con su equivalente externo, mediante una comparación.

3. Adicionalmente, se cuenta con el botón *Reset Data*, el cual deberemos de usar después de ejecutar los métodos de arriba, para limpiar las operaciones cometidas en base de datos y hacer un nuevo analisis.

   

   

   

## Check Data Status

1. Al entrar a este modo de trabajo se listaran todas las tablas que seleccionamos previamente en la vista inicial. Al hacer click en una de ellas a su lado se cargaran todas las columnas que esta contiene.
2. Posteriormente, al hacer click en uno de los campos desplegados aparecerán las diferentes reglas que se le pueden aplicar de acuerdo a su tipo.
3. En la versión actual del programa, solo se puede trabajar con un campo a la vez y a este se le puede aplicar múltiples reglas; Y se cuenta con dos tipos: varchar e integer.
4. En el momento en que se presione una regla, esta mostrara una ventana que pedirá ingresar un valor para trabajar en conjunto a la condición de dicha regla.
5. Ademas, en caso de que las reglas sean para texto, se pedirá también que se marque si nuestra búsqueda en Case-Sensitive o no. 
6. Cuando tengamos nuestro campo preparado, podremos realizar su búsqueda mediante el botón *Apply Selected Rules*, el cual nos llevara a una nueva vista que renderizara una tabla con los elementos con los que se a hecho match.

## Compare Data

1. Al entrar a este modo de trabajo se muestran todas las tablas que seleccionamos previamente en la vista inicial. Al hacer click en una de ellas, se mostraran todas sus columnas con un check por defecto.
2. Esto debido a que, en principio, todas están siendo consideras para la comparación. Tenemos la posibilidad también de desmarcar las que sean de nuestro interés para que el sistema las ignore. 
3. Con el botón superior *Compare Tables* podremos pasar a la vista final de comparación, independientemente de que hayamos desmarcado algún campo o no.
4. La ultima vista nos permite realizar una comparación a la vez, seleccionando la tabla con el select de la parte superior.
5. Al momento de realizar la operación y que no se encuentren imperfecciones solo se mostrara un mensaje de que todo esta bien; Caso contrario, se listaran todas las filas en las que hay por lo menos un error.
6. Arriba de los contenedores de resultado también se cuenta con todas las columnas de dicha tabla, para permitir un filtrado que haga más limpia la revisión.










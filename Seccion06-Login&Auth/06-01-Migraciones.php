<?php

/*
Las migraciones son el control de columnas que va a tener nuestra BBDD.

Las migraciones se crean con el siguiente comando de artisan:
php artisan make:model NombreDelModelo --migration

el comando PHP ARTISAN MIGRATE:FRESH, lleva las migraciones a la base de datos
de modo que no tenemos que estar escribiendo nosotros mismos las bbdd
pudiendo caer en errores y perdiendo tiempo

El comando PHP ARTISAN MIGRATE:ROLLBACK devuelve a la ultima versión de la migración
por si hubo algún error

En las migraciones los tipos de columnas son:

bigIncrements: Ideal para PK
Char: Tipo char
Float: Número con decimales
Integer: Numeros enteros
String: Tipo varchar
Text: Tipo text

NO SE RECOMIENDA USAR VARCHAR

*/
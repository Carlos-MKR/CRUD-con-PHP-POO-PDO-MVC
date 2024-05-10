<?php

//credenciales de la base de datos
// conexion local o de desarollo
define('LDB_ENGINE', 'mysql');
define('LDB_HOST', 'localhost');
define('LDB_NAME', 'crud_usuarios');
define('LDB_USER', 'root');
define('LDB_PASS', '');
define('LDB_CHARSET', 'utf8');
// conexion en produccion 
define('DB_ENGINE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', '');
define('DB_USER', '');
define('DB_PASS', '');
define('DB_CHARSET', '');

/**
 * se pueden añadir todas las configuraciones necesarias
 * 
 * eje:
 * controlador por defecto / metodo por defecto / controlador de errores por defecto
 *   define('DEFAULT_CONTROLLER', 'home');
 *   define('DEFAULT_ERROR_CONTROLLER', 'error');
 *   define('DEFAULT_METHOD', 'index');
 */



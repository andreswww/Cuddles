<?php
 
// datos para la conexion a mysql
define('DB_SERVER','127.0.0.1');
define('DB_NAME','hanselit');
define('DB_USER','root');
define('DB_PASS','');
 
    $con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS);
    mysqli_select_db($con, DB_NAME);
    
 
?>
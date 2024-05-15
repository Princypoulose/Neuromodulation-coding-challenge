<?php
$serverName = "DESKTOP-BH3H7PG\SQLEXPRESS"; 
$connectionOptions = array(
    "Database" => " Neuromodulation", 
    "Uid" => "Princy", 
    "PWD" => "Princy24@sql" 
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}else //echo'success';
?>

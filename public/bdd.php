<?php

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=reservas;charset=utf8', 'root', '');
}
catch(Exception $e)
{
    die('Error : '.$e->getMessage());
}



// Conectarse a la base de datos

$conexion = new mysqli("localhost", "root", "", "reservas");
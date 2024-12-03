<?php

$servername = 'db';
$username = 'root';
$password = 'test';
$dbname = 'tareas';
// Crea la conexión

try {
    $conPDO = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    //  Forzar excepciones
    $conPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'Conexión correcta';
  } catch(PDOException $e) {
    echo 'Fallo en conexión: ' . $e->getMessage();
  }



//


// Cierra la conexión
$conPDO = null;

?>
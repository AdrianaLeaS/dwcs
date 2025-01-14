<?php
session_start();
//Si no existe una sesion usuario lo redirijo a la pagina a logearse
if(!isset $_SESSION(['usuario'])) {
    header("Location: login.php?redirect=true");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD3. Donaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
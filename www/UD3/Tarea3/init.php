<?php 
// Crea la conexión
$conexion = new mysqli ('db', 'root', 'test', 'tareas');
$error = $conexion->connect_error;
// Comprueba la conexion
if($error !=null){
    die('Fallo en la conexion: '.$error.);
}
echo 'Conexión correcta <br>';

// Crear la base de datos
try {

    $conexion = new mysqli('db', 'root', 'test');
    echo 'Conexion correcta';

    $sql = 'CREATE DATABASE IF NOT EXISTS tareas';
    if ($conexion->query($sql)) {
        echo 'Base de datos creada con  éxito <br>'
    }else {
        echo 'Error creando la base de datos: '.$conexion->error . <br>;

    }

}catch(mysqli_sql_exception $e) {
    echo 'Error en la conexión: '.$e->getMessage();

}

// Crear la tabla usuarios

try {

    $sql = 'CREATE TABLE IF NOT EXISTS usuarios(
        id INT(6) AUTO_INCREMENT PRIMARY KEY, 
        username VARCHAR(50) NOT NULL, 
        nombre VARCHAR(50) NOT NULL,
        apellido VARCHAR(100) NOT NULL,
        contraseña VARCHAR(100) NOT NULL
    )';

    $conexion->select_db('tareas');
    if ($conexion->query($sql)) {
        echo 'Tabla creada con  éxito <br>'
    }else {
        echo 'Error creando la tabla usuarios: '.$conexion->error . <br>;

    }

}catch(mysqli_sql_exception $e) {
    echo 'Error en la conexión: '.$e->getMessage();

 
}


// Crear la tabla tareas

try {

    $sql = 'CREATE TABLE IF NOT EXISTS tareas(
        id INT(6) AUTO_INCREMENT PRIMARY KEY, 
        utitulo VARCHAR(50) NOT NULL, 
        descripcion VARCHAR(250) NOT NULL,
        estado VARCHAR(50) NOT NULL,
        id_usuario INT(6),
        FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
    )';

    $conexion->select_db('tareas');
    if ($conexion->query($sql)) {
        echo 'Tabla creada con  éxito <br>'
    }else {
        echo 'Error creando la tabla usuarios: '.$conexion->error . <br>;

    }

}catch(mysqli_sql_exception $e) {
    echo 'Error en la conexión: '.$e->getMessage();

 
}


// Cierra la conexión
$conexion ->close();
?>
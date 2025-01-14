<?php 
// Crea la conexión
function conectar($host, $user, $pass, $db) {

    $conexion = new mysqli ($host, $user, $pass, $db); 

    $error = $conexion->connect_error;

    return $conexion;
    
    /* Comprueba la conexion
    if($error!=null){
        die('Fallo en la conexion: '.$error);
    }
    echo 'Conexión correcta <br>';*/

}

function cerrarConexion ($conexion) {

    // Cierra la conexión
    if (isset($conexion) && $conexion->connect_errno === 0) {
        $conexion->close();
    }
}



// Crear la base de datos
function crearDB () {
    try {

        $conexion = conectar('db', 'root', 'test', null);
        if ($conexion->connect_error !=null) {
            die('Fallo en la conexion: '.$error);

        }else{

            //Para verificar si laa DB existe
            $sqlCheck = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'tareas'";
            $resultado = $conexion->query($sqlCheck);
            if ($resultado && $resultado->num_rows >0){
                echo 'La base de datos "tareas" ya existe.';
            }else {
            
            $sql = 'CREATE DATABASE IF NOT EXISTS tareas';
            if ($conexion->query($sql) ) {
                echo 'Base de datos creada con  éxito <br>';
            }else{
                echo 'Error creando la base de datos: '.$conexion->error . '<br>';
            }
        }
        }
    
    }catch(mysqli_sql_exception $e) {
        echo 'Error en la conexión: '.$e->getMessage();
    
    }finally{
        cerrarConexion($conexion);
    }
}

//Utilizar mi conexion para conectarme a la base de datos

function conectaTareas (){
    return conectar('db', 'root', 'test', 'tareas');
}

// Crear la tabla usuarios

function crearTablaUsuarios () {


try {
    //En primer lugar me conecto a la base de datos
    $conexion = conectaTareas();

    if($conexion->connect_error !=null){
       die ('Fallo en la conexión a la base de datos: '.$conexion->connect_error);
    }else {

        //Verificamos si la tabla existe
        $sqlCheck = "SHOW TABLES LIKE 'usuarios'";
        $resultado = $conexion->query($sqlCheck);

        if ($resultado && $resultado->num_rows >0){
           echo 'La tabla "usuarios" ya existe.';
        }else {

        $sql = 'CREATE TABLE IF NOT EXISTS usuarios(
            id INT(6) AUTO_INCREMENT PRIMARY KEY, 
            username VARCHAR(50) NOT NULL, 
            nombre VARCHAR(50) NOT NULL,
            apellido VARCHAR(100) NOT NULL,
            contrasena VARCHAR(100) NOT NULL
        )';

        if ($conexion->query($sql)) {
            echo 'Tabla creada con  éxito <br>';
        }else {
            echo 'Error creando la tabla usuarios: '.$conexion->error . '<br>';

        }
    }
    }

}catch(mysqli_sql_exception $e) {
    echo 'Error en la conexión: '.$e->getMessage();

 
} finally {
    cerrarConexion($conexion);
}
}

// Crear la tabla tareas
function crearTablaTareas (){

try {

    // Me conecto a la base de datos
    $conexion = conectaTareas();

    if ($conexion->connect_error !=null) {
        die('Fallo al conectar la base de datos. '.$conexion->$connect_error.'<br>');
        

    }else {

        //Verificamos si la tabla existe
        $sqlCheck = "SHOW TABLES LIKE 'tareas'";
        $resultado = $conexion->query($sqlCheck);

        if ($resultado && $resultado->num_rows >0){
            echo 'La tabla tareas ya existe';
        }else {
            $sql = 'CREATE TABLE IF NOT EXISTS tareas(
                id INT(6) AUTO_INCREMENT PRIMARY KEY, 
                utitulo VARCHAR(50) NOT NULL, 
                descripcion VARCHAR(250) NOT NULL,
                estado VARCHAR(50) NOT NULL,
                id_usuario INT(6),
                FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
            )';
            if ($conexion->query($sql)) {
                echo 'Tabla creada con éxito <br>';

            }else{
                echo 'No se ha podido crear la tabla "tareas"'.$conexion->error.'<br>';
            }
        }
}

}catch(mysqli_sql_exception $e) {
    echo 'Error en la conexión: '.$e->getMessage();

 
}finally {
    cerrarConexion($conexion);
}

}



?>
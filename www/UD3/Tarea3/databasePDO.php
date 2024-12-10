<?php
function conectaPDO (){
$servername = 'db';
$username = 'root';
$password = 'test';
$dbname = 'tareas';

try {
    $conexionPDO = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conexionPDO;
}catch(PDOException $e) {
    echo 'Fallo en la conexión: '. $e->getMessage();
}
}

function cierraPDO() {
    $conexionPDO = null;
}

function listaUsuarios () {

    try {
        $conexionPDO = conectaPDO();
        $stmt = $conexionPDO->prepare('SELECT id, username, nombre, apellido FROM usuarios');
        $stmt->execute();

       // $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            return $resultado;
        
        
    }catch(PDOException $e){
        echo 'Fallo al mostrar la lista: '.$e->getMessage();
    }finally{
        cierraPDO();
    }

}

function nuevoUsuario ($nombre, $apellido, $username, $contrasena) {
    try {
        $conexionPDO = conectaPDO();
        
        $stmt = $conexionPDO->prepare("INSERT INTO usuarios (nombre, apellido, username, contrasena) VALUES (:nombre, :apellido, :username, :contrasena)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->execute();

        $stmt->closeCursor();

        return [true, null];

    }catch(PDOException $e){
        echo 'Error al crear usuario '.$e->getMessage();
    }finally{
        cierraPDO();
    }
}

    function actualizaUsuario ($id, $nombre, $apellido, $username, $contrasena) {

        try {
            $conexionPDO = conectaPDO();
            
            $stmt = $conexionPDO->prepare("UPDATE usuarios SET nombre = :nombre, apellido = :apellido, username = :username, contrasena = :contrasena WHERE id= :id");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':contrasena', $contrasena);
            $stmt->bindParam ( ':id', $id);

            $stmt->execute();

            $stmt->closeCursor();
    
    
        }catch(PDOException $e){
            echo 'Error al actualizar usuario '.$e->getMessage();
        }finally{
            cierraPDO();
        }
    }

    function borrarUsuario ($id) {
        try{
            $conexionPDO = conectaPDO();
            //Para borrar se establece una transaccion de forma que si no hay errores se confirman todos los cambios en el commit. Si no se revierten todos y no se realiza ninguno.
            $conexionPDO->beginTransaction();

            $stmt=$conexionPDO->prepare("DELETE FROM tareas WHERE id_usuario=".$id);
            $stmt->execute(); 
            $stmt = $conexionPDO->prepare("DELETE FROM usuarios WHERE id =" .$id);
            $stmt->execute();
            $resultado = $conexionPDO->commit();

        }catch (PDOException $e){
            echo $e->getMessage();
        }finally{
            cierraPDO();
        }
    }


?>
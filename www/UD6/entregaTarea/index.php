<?php

declare(strict_types=1);

require_once 'flight/Flight.php';
// require 'flight/autoload.php';

Flight::register('db', 'PDO', array('mysql:host=db;dbname=agenda','root','test'));

//Registrar es añadir un usuario
Flight::route ('POST /register', function()
{

    $nombre= Flight::request()->data->nombre;
    $email= Flight::request()->data->email;
    $password= password_hash(Flight::request()->data->password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :email, :password)";
    $sentencia = Flight::db()->prepare($sql);

    try{
        $sentencia->bindParam(':nombre', $nombre);
        $sentencia->bindParam(':email', $email);
        $sentencia->bindParam(':password', $password);
        $sentencia->execute();

        Flight::json(['Usuario registrado correctamente']);

    } catch (PDOException $e) {
        Flight::json(['error' => 'Error al registrar usuario (posible email duplicado)'], 400);
    }

});

//Logearse es buscar un usuario en la tabla
Flight::route ('POST /login', function()
{
    
    $email= Flight::request()->data->email;
    $password= Flight::request()->data->password;

    $sql = "SELECT *FROM usuarios WHERE email=:email";
    $sentencia = Flight::db()->prepare($sql);
    $sentencia ->bindParam(':email', $email);
    $sentencia->execute();

    $user = $sentencia->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($password, $user['password'])) {
        $token = bin2hex(random_bytes(32));

        $sentencia = Flight::db()->prepare("UPDATE usuarios SET token=:token WHERE id=:id");
        $sentencia->bindParam(':token', $token);
        $sentencia->bindParam(':id', $user['id']);

        $sentencia->execute();

        Flight::json(['token'=>$token]);
    }else {
        Flight::json(['error'=>'Credenciales no válidas'], 401);
    }

    
});


Flight::before('start', function(&$params, &$output){
    $ruta = Flight::request()->url;
    if (str_starts_with($ruta, '/contactos')) { //Va a proteger rotdas las rutas que empiecen por /contactos
        $token = Flight::request()->getHeader('X-Token');
        if (!$token) {
            Flight::halt(401, json_encode(['error' => 'Token no enviado']));
        }

        $sql = "SELECT * FROM usuarios WHERE token = :token";
        $sentencia = Flight::db()->prepare($sql);
        $sentencia->bindParam(':token', $token);
        $sentencia->execute();
        $user = $sentencia->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            Flight::halt(401, json_encode(['error' => 'Token no válido']));
        }

        Flight::set('user', $user);
    }
});


// Listado de todos los contactos
Flight::route ('GET /contactos', function()
{
    $user = Flight::get('user');
    $usuario_id = $user['id'];
    
    $sql = "SELECT * FROM contactos WHERE usuario_id=:usuario_id";

    $sentencia = Flight::db()->prepare ($sql);

    $sentencia->bindParam(":usuario_id", $usuario_id);
    $sentencia ->execute();

  
    $datos = $sentencia ->fetchAll();
    Flight::json($datos);
});

// Contacto por id
Flight::route ('GET /contactos/@id', function($id)
{
    $user = Flight::get('user');
    
    $usuario_id = $user['id'];
    
    $sql = "SELECT * FROM contactos WHERE id = :id AND usuario_id=:usuario_id";

    $sentencia = Flight::db()->prepare ($sql);

    $sentencia->bindParam(":id", $id);
    $sentencia->bindParam(":usuario_id", $usuario_id);
    $sentencia ->execute();

    
    $contacto = $sentencia->fetch(PDO::FETCH_ASSOC);

    if($contacto) {
        Flight::json ($contacto);
    }else {
        Flight::json (["error" => "Contacto no encontrado"], 404);
    }
    
});

//Añadir contactos
Flight::route ('POST /contactos', function()
{
    $user = Flight::get('user');

    $nombre= Flight::request()->data->nombre;
    $telefono= Flight::request()->data->telefono;
    $email= Flight::request()->data->email;

    $sql ="INSERT INTO contactos(nombre, telefono, email, usuario_id) VALUES (:nombre, :telefono, :email, :usuario_id)";

    $sentencia = Flight::db()->prepare($sql);

    $sentencia->bindParam (":nombre", $nombre); 
    $sentencia->bindParam (":telefono", $telefono);
    $sentencia->bindParam (":email", $email);
    $sentencia->bindParam (":usuario_id", $user['id']);

    $sentencia->execute();


    FLight::json (["Conacto agregado correctamente"]);
});

//Editar contactos buscando por id
Flight::route ('PUT /contactos', function()
{
    $user = Flight::get('user');

    $id= Flight::request()->data->id;
    $usuario_id = $user['id'];
    
    $sql = "SELECT * FROM contactos WHERE id = :id AND usuario_id=:usuario_id";

    $sentencia = Flight::db()->prepare ($sql);

    $sentencia->bindParam(":id", $id);
    $sentencia->bindParam(":usuario_id", $usuario_id);
    $sentencia ->execute();


    if(!$sentencia->fetch()) {
        Flight::json (["error" => "Usuario no autorizado"]);
    }


    $nombre= Flight::request()->data->nombre;
    $telefono= Flight::request()->data->telefono;
    $email= Flight::request()->data->email;
   

    $sql ="UPDATE contactos set nombre=:nombre, telefono=:telefono, email=:email WHERE id=:id";

    $sentencia = Flight::db()->prepare($sql);

    $sentencia->bindParam (":id", $id);
    $sentencia->bindParam (":nombre", $nombre);
    $sentencia->bindParam (":telefono", $telefono);
    $sentencia->bindParam (":email", $email);
    

    $sentencia->execute();


    FLight::json (["Contacto con id: $id actualizado correctamente"]);
});

//Borrar contactos por id
Flight::route ('DELETE /contactos/delete', function()
{
    $user = Flight::get('user');

    $id= Flight::request()->data->id;
    $usuario_id = $user['id'];
    
    $sql = "DELETE FROM contactos WHERE id = :id AND usuario_id=:usuario_id";

    $sentencia = Flight::db()->prepare ($sql);

    $sentencia->bindParam(":id", $id);
    $sentencia->bindParam(":usuario_id", $usuario_id);
    $sentencia ->execute();


    if($sentencia->rowCount()>0){
        Flight::json (["Contacto con id: $id eliminado correctamente"]);
    }else {
        Flight::json (["error" => "Contacto no encontrado o usuario no autorizado"], 403);
    }


    
});


Flight::start();

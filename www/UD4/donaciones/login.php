<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login y sesiones</title>
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>
<!-- Crear un formulario para recoger losdatos para logearse -->
    <div class="form-container">
        <h2>Iniciar sesión</h2>

        <?php
        //Los datos como tal se van a validar en auth. Aquí...


        //Definimos que es redirect, error y mesagge (variables booleanas).
        $redirect = isset($_GET['redirect'])? true:false;
        $error = isset($_GET['error']) ? true:false;
        $message = isset($_GET['message']) ? $_GET['message'] : null;
        //Que mensaje mostrar si alguna de las variables es true.
        if($redirect){
            echo 'Debes iniciar sesion';
        }elseif ($error){

            if($message){
                echo 'Error: '. $message;
            }else {
                echo 'Usuario y contraseña incorrectos';
            }
            
        }
        ?>

        <form action="auth.php" method="POST"> 
            <!-- Los datos del formulario se me redirigen a auth.php para validarse -->
            <label for="usuario">Usuario:</label>
            <input name="usuario" id="usuario" type="text" placeholder="Introduce el usuario">

            <label for="pass">Contraseña:</label>
            <input name="pass" id="pass" type="password" placeholder="Introduce la contraseña">

            <input type="submit" value="Iniciar Sesión">
        </form>
    </div>
    </body>
</html>